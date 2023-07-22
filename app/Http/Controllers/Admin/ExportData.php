namespace App\Http\Controllers\Admin;

class ExportData
{
    public $columns;
    public $data;

    public function __construct($columns, $data)
    {
        $this->columns = $columns;
        $this->data    = $data;
    }
}
