<?php

namespace App\Models;
use App\Repositories\BillRepository;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Eloquent as Model;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage;
use Str;

/**
 * Class Bill
 *
 * @version February 13, 2022, 9:47 am UTC
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static Builder|Bill newModelQuery()
 * @method static Builder|Bill newQuery()
 * @method static Builder|Bill query()
 * @method static Builder|Bill whereAmount($value)
 * @method static Builder|Bill whereBillDate($value)
 * @method static Builder|Bill whereCreatedAt($value)
 * @method static Builder|Bill whereId($value)
 * @method static Builder|Bill wherePatientId($value)
 * @method static Builder|Bill whereUpdatedAt($value)
 * @mixin Model
 * @property int $patient_id
 * @property \Illuminate\Support\Carbon $bill_date
 * @property float $amount
 * @property-read Collection|BillItems[] $billItems
 * @property-read int|null $bill_items_count
 * @property-read User $patient
 * @property string $patient_admission_id
 * @method static Builder|Bill wherePatientAdmissionId($value)
 * @property string $bill_id
 * @property-read \App\Models\PatientAdmission $patientAdmission
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bill whereBillId($value)
 * @property int $is_default
 * @method static Builder|Bill whereIsDefault($value)
 */
class Bill extends Model
{
    public $table = 'bills';

    public $fillable = [
        'patient_admission_id',
        'patient_id',
        'bill_id',
        'bill_date',
        'amount',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'                   => 'integer',
        'patient_admission_id' => 'string',
        'patient_id'           => 'integer',
        'bill_date'            => 'datetime',
        'amount'               => 'double',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'patient_id' => 'required|integer|min:1',
        'bill_date'  => 'required|string',
    ];

    public static $messages = [
        'patient_id.required' => 'The Admission id field is required.',
        'min'                 => 'Please select at least one patient.',
    ];

    /**
     * @return HasMany
     */
    public function billItems()
    {
        return $this->hasMany(BillItems::class);
    }

    /**
     * @return BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function setBillDateAttribute($value)
    {
        $this->attributes['bill_date'] = Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    /**
     * @return HasOne
     */
    public function patientAdmission()
    {
        return $this->hasOne(PatientAdmission::class, 'patient_id', 'patient_id');
    }

    /**
     * @return string
     */
    public static function generateUniqueBillId()
    {
        $billId = mb_strtoupper(Str::random(6));
        while (true) {
            $isExist = self::whereBillId($billId)->exists();
            if ($isExist) {
                self::generateUniqueBillId();
            }
            break;
        }

        return $billId;
    }

    function prepareBills(): array
    {
        $fields = [
            'id'        => $this->id,
            'bill_id'   => $this->bill_id,
            'bill_time' => Carbon::parse($this->bill_date)->format('g:i A'),
            'bill_date' => Carbon::parse($this->bill_date)->format('jS M, Y'),
            'amount'    => $this->amount,
            'currency'  => getCurrencySymbol(),
        ];

        return $fields;
    }

    /**
     * @throws BindingResolutionException
     */
    function prepareBillDetails(): array
    {
        $admissionDate = Carbon::parse($this->patientAdmission->admission_date);
        $dischargeDate = Carbon::parse($this->patientAdmission->discharge_date);
        $fields = [
            'id'                   => $this->id,
            'bill_id'              => $this->bill_id,
            'bill_time'            => isset($this->bill_date) ? Carbon::parse($this->bill_date)->format('g:i A') : '',
            'bill_date'            => isset($this->bill_date) ? Carbon::parse($this->bill_date)->format('jS M, Y') : '',
            'amount'               => $this->amount ?? null,
            'currency'             => getCurrencySymbol(),
            'patient_admission_id' => $this->patient_admission_id ?? '',
            'admission_detail'     => [
                'phone'          => getLoggedInUser()->phone ?? '',
                'doctor'         => $this->patientAdmission->doctor->doctorUser->full_name,
                'admission_date' => isset($this->patientAdmission->admission_date) ? Carbon::parse($this->patientAdmission->admission_date)->format('jS M, Y') : '',
                'admission_time' => isset($this->patientAdmission->admission_date) ? Carbon::parse($this->patientAdmission->admission_date)->format('g:i A') : '',
                'discharge_date' => isset($this->patientAdmission->discharge_date) ? Carbon::parse($this->patientAdmission->discharge_date)->format('jS M, Y') : '',
                'discharge_time' => isset($this->patientAdmission->discharge_date) ? Carbon::parse($this->patientAdmission->discharge_date)->format('g:i A') : '',
                'created_at'     => $this->patientAdmission->created_at->diffForHumans(),
            ],
            'insurance_detail'     => [
                'package_name'   => $this->patientAdmission->package->name ?? '',
                'insurance_name' => $this->patientAdmission->insurance->name ?? '',
                'total_days'     => $admissionDate->diffInDays($dischargeDate) + 1,
                'policy_no'      => $this->patientAdmission->insurance->policy_no ?? '',
            ],
            'item_details'         => $this->billItems,
            'bill_download'        => $this->convertToPdf($this->id),
        ];

        return $fields;
    }

    /**
     * @param $id
     *
     * @throws BindingResolutionException
     *
     * @return string
     */
    public function convertToPdf($id): string
    {
        $bill = Bill::with('billItems')->find($id);
        $data = App()->make(billRepository::class)->getSyncListForCreate($id);
        $data['bill'] = $bill;
        if (Storage::exists('bills/Bill-'.$bill->bill_id.'.pdf')) {
            Storage::delete('bills/Bill-'.$bill->bill_id.'.pdf');
        }
        $pdf = PDF::loadView('bills.bill_pdf', $data);
        Storage::disk(config('app.media_disc'))->put('bills/Bill-'.$bill->bill_id.'.pdf', $pdf->output());
        $url = Storage::url('bills/Bill-'.$bill->bill_id.'.pdf');

        return $url ?? '';
    }

}
