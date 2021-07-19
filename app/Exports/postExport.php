<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use App\Models\Post;
use DB;

class PostExport implements FromCollection,WithHeadings, ShouldAutoSize,WithEvents
{
//   public function __construct(string $email)
//   {
//     $this->email = $email;
//  }

  public function collection()
  {
    return DB::table('posts')
                ->select('posts.id','users.name','posts.title','posts.description')
                ->join('users','users.id','=','posts.created_user_id')
                ->get();
  }

  public function headings():array
  {
    return ["ID", "Name", "Title","Description"];
  }

    /**
     * @return array
    */
    public function registerEvents(): array
    {
      return [
          AfterSheet::class    => function(AfterSheet $event) {
          $cellRange = 'A1:W1'; // All headers
          $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
        },
      ];
    }
}
?>