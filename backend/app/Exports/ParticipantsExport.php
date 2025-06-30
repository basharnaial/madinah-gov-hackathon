<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Illuminate\Support\Collection;

class ParticipantsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles, WithTitle
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
            'رقم المشارك',
            'الاسم الكامل',
            'البريد الإلكتروني',
            'رقم الهاتف',
            'العمر',
            'المدينة',
            'مجال الاهتمام',
            'نوع التسجيل',
            'أعضاء الفريق/المنظمة',
            'فكرة المشروع',
            'الحالة',
            'درجة التحكيم',
            'ملاحظات التحكيم',
            'تاريخ التسجيل',
            'تاريخ آخر تحديث',
        ];
    }

    /**
     * @param mixed $participant
     * @return array
     */
    public function map($participant): array
    {
        // Get field of interest in Arabic
        $fieldOfInterestAr = $this->getFieldOfInterestArabic($participant->field_of_interest);
        
        // Get registration type in Arabic
        $registrationTypeAr = $this->getRegistrationTypeArabic($participant->registration_type);
        
        // Get status in Arabic
        $statusAr = $this->getStatusArabic($participant->status);
        
        // Get team members
        $teamMembers = '';
        if ($participant->registration_type === 'Team' || $participant->registration_type === 'Organization') {
            $teamMembers = $participant->teamMembers->pluck('name')->join(', ');
        }
        
        // Get evaluation details
        $evaluationScore = $participant->evaluation ? $participant->evaluation->score . '%' : 'لم يتم التحكيم';
        $evaluationDescription = $participant->evaluation ? $participant->evaluation->description : 'لم يتم التحكيم';
        
        return [
            $participant->id,
            $participant->full_name,
            $participant->email,
            $participant->phone,
            $participant->age,
            $participant->city,
            $fieldOfInterestAr,
            $registrationTypeAr,
            $teamMembers,
            $participant->project_idea ?? 'لا يوجد',
            $statusAr,
            $evaluationScore,
            $evaluationDescription,
            $participant->created_at->format('Y-m-d H:i:s'),
            $participant->updated_at->format('Y-m-d H:i:s'),
        ];
    }
    
    /**
     * Get Arabic translation for field of interest
     */
    private function getFieldOfInterestArabic($field): string
    {
        $fieldMap = [
            'SmartMonitoring' => 'المتابعة الذكية للخدمات والمرافق',
            'InteractiveTourism' => 'إثراء تجربة الزائر',
            'SmartMobility' => 'النقل الذكي والتنقل المستدام',
            'DigitalHealthcare' => 'الرعاية الصحية الرقمية',
            'EnvironmentalTech' => 'التقنية البيئية',
            'SmartInfrastructure' => 'البنى التحتية الذكية',
            'Other' => 'أخرى',
        ];
        
        return $fieldMap[$field] ?? $field;
    }
    
    /**
     * Get Arabic translation for registration type
     */
    private function getRegistrationTypeArabic($type): string
    {
        $typeMap = [
            'Individual' => 'فردي',
            'Team' => 'فريق',
            'Organization' => 'منظمة',
        ];
        
        return $typeMap[$type] ?? $type;
    }
    
    /**
     * Get Arabic translation for status
     */
    private function getStatusArabic($status): string
    {
        $statusMap = [
            'Pending' => 'في الانتظار',
            'Approved' => 'مقبول',
            'Rejected' => 'مرفوض',
        ];
        
        return $statusMap[$status] ?? $status;
    }
    
    /**
     * @return string
     */
    public function title(): string
    {
        return 'قائمة المشاركين - ' . date('Y-m-d');
    }
    
    /**
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the header row
            1 => [
                'font' => [
                    'bold' => true,
                    'size' => 12,
                    'color' => ['rgb' => 'FFFFFF'],
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '4F46E5'],
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],
            // Style all cells
            'A:O' => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_RIGHT,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true,
                ],
                'font' => [
                    'size' => 10,
                ],
            ],
        ];
    }
}
