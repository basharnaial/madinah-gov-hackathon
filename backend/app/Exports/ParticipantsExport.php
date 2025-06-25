<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Collection;

class ParticipantsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $participants;

    public function __construct(Collection $participants)
    {
        $this->participants = $participants;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->participants;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'الاسم الكامل',
            'البريد الإلكتروني',
            'رقم الهاتف',
            'العمر',
            'المدينة',
            'مجال الاهتمام',
            'نوع التسجيل',
            'فكرة المشروع',
            'الحالة',
            'تاريخ التسجيل',
        ];
    }

    /**
     * @param mixed $participant
     * @return array
     */
    public function map($participant): array
    {
        return [
            $participant->id,
            $participant->full_name,
            $participant->email,
            $participant->phone,
            $participant->age,
            $participant->city,
            $participant->field_of_interest,
            $participant->registration_type,
            $participant->project_idea ?? '',
            $participant->status,
            $participant->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
