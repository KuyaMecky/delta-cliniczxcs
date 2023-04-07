<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\HigherOrderBuilderProxy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;

/**
 * Class LiveConsultation
 *
 * @property int $id
 * @property int $doctor_id
 * @property int $patient_id
 * @property string $consultation_title
 * @property string $consultation_date
 * @property int $host_video
 * @property int $participant_video
 * @property string $consultation_duration_minutes
 * @property string $type
 * @property string $type_number
 * @property string $created_by
 * @property int $status
 * @property string|null $description
 * @property string $meeting_id
 * @property array|null $meta
 * @property string $time_zone
 * @property string $password
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Doctor $doctor
 * @property-read string $status_text
 * @property-read \App\Models\IpdPatientDepartment $ipdPatient
 * @property-read \App\Models\OpdPatientDepartment $opdPatient
 * @property-read \App\Models\Patient $patient
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultation query()
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultation whereConsultationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultation whereConsultationDurationMinutes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultation whereConsultationTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultation whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultation whereDoctorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultation whereHostVideo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultation whereMeetingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultation whereMeta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultation whereParticipantVideo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultation wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultation wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultation whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultation whereTimeZone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultation whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultation whereTypeNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class LiveConsultation extends Model
{
    /**
     * @var string
     */
    protected $table = 'live_consultations';

    const OPD = 0;
    const IPD = 1;

    const HOST_ENABLE = 1;
    const HOST_DISABLED = 0;

    const CLIENT_ENABLE = 1;
    const CLIENT_DISABLED = 0;

    const STATUS_AWAITED = 0;
    const STATUS_CANCELLED = 1;
    const STATUS_FINISHED = 2;

    const STATUS_TYPE = [
        self::OPD => 'OPD',
        self::IPD => 'IPD',
    ];

    const status = [
        self::STATUS_AWAITED   => 'Awaited',
        self::STATUS_CANCELLED => 'Cancelled',
        self::STATUS_FINISHED  => 'Finished',
    ];

    const FILTER_STATUS = [
        0 => 'All',
        1 => 'Awaited',
        2 => 'Cancelled',
        3 => 'Finished',
    ];

    /**
     * @var string[]
     */
    protected $appends = ['status_text'];

    /**
     * @var string[]
     */
    protected $fillable = [
        'doctor_id',
        'patient_id',
        'consultation_title',
        'consultation_date',
        'consultation_duration_minutes',
        'type',
        'type_number',
        'description',
        'created_by',
        'status',
        'meta',
        'meeting_id',
        'time_zone',
        'password',
        'host_video',
        'participant_video',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'patient_id'                    => 'required',
        'doctor_id'                     => 'required',
        'consultation_title'            => 'required',
        'consultation_date'             => 'required',
        'consultation_duration_minutes' => 'required|numeric|min:0|max:720',
        'type'                          => 'required',
        'type_number'                   => 'required',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'meta' => 'array',
    ];

    /**
     * @return string
     */
    public function getStatusTextAttribute()
    {
        return self::status[$this->status];
    }

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
        return $this->belongsTo(Doctor::class);
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * @return BelongsTo
     */
    public function ipdPatient()
    {
        return $this->belongsTo(IpdPatientDepartment::class, 'type_number');
    }

    /**
     * @return BelongsTo
     */
    public function opdPatient()
    {
        return $this->belongsTo(OpdPatientDepartment::class, 'type_number');
    }

    public function prepareLiveConsultation(): array
    {
        return [
            'id'                 => $this->id,
            'consultation_title' => $this->consultation_title,
            'consultation_date'  => isset($this->consultation_date) ? \Carbon\Carbon::parse($this->consultation_date)->format('d F Y') : '',
            'consultation_time'  => isset($this->consultation_date) ? \Carbon\Carbon::parse($this->consultation_date)->format('h:i A') : '',
            'status'             => isset($this->status) ? self::status[$this->status] : '',
        ];
    }

    public function scopeFilter($query)
    {
        if (request()->status) {
            $request = request();
            $query->when(isset($request->status), function (Builder $q) use ($request) {
                if ($request->status == 1) {
                    $q->where('status', LiveConsultation::STATUS_AWAITED);
                }
                if ($request->status == 2) {
                    $q->where('status', LiveConsultation::STATUS_CANCELLED);
                }
                if ($request->status == 3) {
                    $q->where('status', LiveConsultation::STATUS_FINISHED);
                }
            });
        }

        return $query;
    }

    public function prepareLiveConsultationDetail(): array
    {
        return [
            'id'                 => $this->id,
            'consultation_title' => $this->consultation_title,
            'consultation_date'  => isset($this->consultation_date) ? \Carbon\Carbon::parse($this->consultation_date)->format('d F Y') : '',
            'consultation_time'  => isset($this->consultation_date) ? \Carbon\Carbon::parse($this->consultation_date)->format('h:i A') : '',
            'status'             => isset($this->status) ? self::status[$this->status] : '',
            'duration'           => $this->consultation_duration_minutes ?? '',
            'doctor_name'        => $this->doctor->doctorUser->full_name ?? '',
            'meeting_id'         => $this->meeting_id,
            'password'           => $this->password ?? '',
            'host_video'         => $this->user->full_name ?? '',
            'type'               => isset($this->type) ? self::STATUS_TYPE[$this->type] : '',
            'type_number'        => $this->getTypeNumber($this->type, $this->patient_id),
        ];
    }

    /**
     * @param $type
     * @param $patientId
     *
     *
     * @return HigherOrderBuilderProxy|mixed|string
     */
    public function getTypeNumber($type, $patientId)
    {
        if (self::OPD == $type) {
            return OpdPatientDepartment::where('patient_id', $patientId)->first()->opd_number ?? '';
        }

        return IpdPatientDepartment::where('patient_id', $patientId)->first()->ipd_number ?? '';
    }
}
