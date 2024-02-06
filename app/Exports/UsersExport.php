<?php

namespace App\Exports;

use App\Enums\UserStatus;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\ConditionalFormatting\Wizard;
use Yajra\DataTables\Exports\DataTablesCollectionExport;

class UsersExport extends DataTablesCollectionExport implements WithMapping, ShouldAutoSize, WithEvents
{
    const COLOR_PRESENT = '008000';
    const COLOR_ABSENT = 'ff0000';
    protected $total;
    protected $counter = 0;

    /**
     * Get the headings for the exported data.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            __('modules/user.id'),
            __('modules/user.name'),
            __('modules/user.email'),
            __('modules/user.status.title'),
            __('modules/user.created_at'),
            __('modules/user.updated_at'),
        ];
    }

    /**
     * Maps the data of a row to an array.
     *
     * @param mixed $row The row data.
     * @return array The mapped array.
     */
    public function map($row): array
    {
        $status = $row['status'];
        $status = strip_tags($status);
        return [
            $row['id'],
            $row['name'],
            $row['email'],
            $status,
            $row['created_at'],
            $row['updated_at'],
        ];
    }

    /**
     * Register the events for the export.
     *
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                /* Make the sheet headers bold. */
                $cellRange = 'A1:F1';
                $event->sheet
                    ->getDelegate()
                    ->getStyle($cellRange)
                    ->getFont()
                    ->setBold(true);
                $event->sheet->getDelegate()->freezePane('A2');

                /* Change the colour of the status text. */
                $cellRange = 'D1:D' . $this->total ?? 1;
                $conditionalStyles = [];
                $wizardFactory = new Wizard($cellRange);

                $present = ['font' => ['color' => ['rgb' => self::COLOR_PRESENT]]];
                $absent = ['font' => ['color' => ['rgb' => self::COLOR_ABSENT]]];

                $textWizard2 = $wizardFactory->newRule(Wizard::TEXT_VALUE);
                $present = (new \PhpOffice\PhpSpreadsheet\Style\Style())->applyFromArray($present);
                $textWizard2->contains(__('modules/user.status.active'))->setStyle($present);

                $textWizard4 = $wizardFactory->newRule(Wizard::TEXT_VALUE);
                $absent = (new \PhpOffice\PhpSpreadsheet\Style\Style())->applyFromArray($absent);
                $textWizard4->contains(__('modules/user.status.inactive'))->setStyle($absent);

                $conditionalStyles[] = $textWizard2->getConditional();
                $conditionalStyles[] = $textWizard4->getConditional();
                $event
                    ->getSheet()
                    ->getStyle('D')
                    ->setConditionalStyles($conditionalStyles);
            },
        ];
    }
}