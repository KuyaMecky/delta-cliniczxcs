<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Str;

/**
 * Class PatientAdmission
 *
 * @mixin Model
 * @property int $id
 * @property int $patient_id
 * @property int $doctor_id
 * @property string $admission_date
 * @property string $discharge_date
 * @property int|null $package_id
 * @property string|null $insurance_id
 * @property string|null $policy_no
 * @property string|null $agent_name
 * @property string|null $guardian_name
 * @property string|null $guardian_relation
 * @property string|null $guardian_contact
 * @property string|null $guardian_address
 * @property int|null $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Doctor $doctor
 * @property-read Package|null $package
 * @property-read Patient $patient
 * @method static Builder|PatientAdmission newModelQuery()
 * @method static Builder|PatientAdmission newQuery()
 * @method static Builder|PatientAdmission query()
 * @method static Builder|PatientAdmission whereAdmissionDate($value)
 * @method static Builder|PatientAdmission whereAgentName($value)
 * @method static Builder|PatientAdmission whereCreatedAt($value)
 * @method static Builder|PatientAdmission whereDischargeDate($value)
 * @method static Builder|PatientAdmission whereDoctorId($value)
 * @method static Builder|PatientAdmission whereGuardianAddress($value)
 * @method static Builder|PatientAdmission whereGuardianContact($value)
 * @method static Builder|PatientAdmission whereGuardianName($value)
 * @method static Builder|PatientAdmission whereGuardianRelation($value)
 * @method static Builder|PatientAdmission whereId($value)
 * @method static Builder|PatientAdmission whereInsuranceId($value)
 * @method static Builder|PatientAdmission wherePackageId($value)
 * @method static Builder|PatientAdmission wherePatientId($value)
 * @method static Builder|PatientAdmission wherePolicyNo($value)
 * @method static Builder|PatientAdmission whereStatus($value)
 * @method static Builder|PatientAdmission whereUpdatedAt($value)
 * @property string $patient_admission_id
 * @property-read Insurance|null $insurance
 * @method static Builder|PatientAdmission wherePatientAdmissionId($value)
 * @property int|null $bed_id
 * @property-read Bed|null $bed
 * @method static Builder|PatientAdmission whereBedId($value)
 * @property int $is_default
 * @method static Builder|PatientAdmission whereIsDefault($value)
 */
class PatientAdmission extends Model
{
    /**
     * @var string
     */
    public $table = 'patient_admissions';

    const STATUS_ALL = 2;
    const ACTIVE = 1;
    const INACTIVE = 0;

    const STATUS_ARR = [
        self::STATUS_ALL => 'All',
        self::ACTIVE     => 'Active',
        self::INACTIVE   => 'Inactive',
    ];
    
    const FILTER_STATUS_ARR = [
        0 => 'All',
        1 => 'Active',
        2 => 'Inactive',
    ];

    /**
     * @var array
     */
    public $fillable = [
        'patient_admission_id',
        'patient_id',
        'doctor_id',
        'admission_date',
        'discharge_date',
        'package_id',
        'insurance_id',
        'bed_id',
        'policy_no',
        'guardian_name',
        'guardian_relation',
        'guardian_contact',
        'guardian_address',
        'status',
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
        'doctor_id'            => 'integer',
        'package_id'           => 'integer',
        'insurance_id'         => 'string',
        'policy_no'            => 'string',
       
        'guardian_name'        => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'patient_id'     => 'required',
        'doctor_id'      => 'required',
        'admission_date' => 'required',
    ];

    /**
     * @return BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    /**
     * @return BelongsTo
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    /**
     * @return BelongsTo
     */
    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }

    /**
     * @return BelongsTo
     */
    public function insurance()
    {
        return $this->belongsTo(Insurance::class, 'insurance_id');
    }

    /**
     * @return BelongsTo
     */
    public function bed()
    {
        return $this->belongsTo(Bed::class, 'bed_id');
    }

    /**
     * @return string
     */
    public static function generateUniquePatientId()
    {
        $patientAdmissionId = Str::random(8);
        while (true) {
            $isExist = self::wherePatientAdmissionId($patientAdmissionId)->exists();
            if ($isExist) {
                self::generateUniquePatientId();
            }
            break;
        }

        return $patientAdmissionId;
    }

    public function prepareAdmission(): array
    {
        return [
            'id'                   => $this->id,
            'patient_admission_id' => $this->patient_admission_id,
            'doctor_id'            => $this->doctor->id,
            'doctor_name'          => $this->doctor->doctorUser->full_name,
            'doctor_image'         => $this->doctor->doctorUser->api_image_url,
            'admission_date'       => isset($this->admission_date) ? Carbon::parse($this->admission_date)->format('d F y') : '',
            'admission_time'       => isset($this->admission_date) ? Carbon::parse($this->admission_date)->format('h:i A') : '',
            'discharge_date'       => isset($this->discharge_date) ? Carbon::parse($this->discharge_date)->format('d F y') : '',
            'discharge_time'       => isset($this->discharge_date) ? Carbon::parse($this->discharge_date)->format('h:i A') : '',
            'bed_id'               => $this->bed->bed_id ?? '',
            'guardian_name'        => $this->guardian_name ?? '',
            'guardian_relation'    => $this->guardian_relation ?? '',
            'guardian_contact'     => $this->guardian_contact ?? '',
            'guardian_address'     => $this->guardian_address ?? '',
            'created_on'           => $this->created_at->diffForHumans() ?? '',
            'insurance_detail'     => [
                'package_name'   => $this->package->name ?? '',
                'insurance_name' => $this->insurance->name ?? '',
                
                'policy_no'      => $this->policy_no ?? '',
            ],
        ];
    }
}
