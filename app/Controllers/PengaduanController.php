<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
class PengaduanController extends BaseController{
    protected $pengaduann,$tanggapans;

    function __construct()
    {
        $this->pengaduann = new Pengaduan();
        $this->tanggapans = new Tanggapan();
    }

public function index()
{
    if (session()->get('level') == 'masyarakat'){
        $data['pengaduan'] = $this->pengaduann->where(['nik'=>session()->get('nik')])->findAll();
    }else{
        $data['pengaduan'] = $this->pengaduann->findAll();
    }
    return view('pengaduan_view', $data);
}

public function save()
{
    $datafile = $this->request->getFile('foto');
    $filename = $datafile->getRandomName();
        $data = [
            'tgl_pengaduan'=>date('Y-m-d H:i:s'),
            'nik'=>session()->get('nik'),
            'isi_laporan'=>$this->request->getPost('isi_laporan'),
            'foto'=>$filename,
            'status'=>'0'
        ];
        $this->pengaduann->insert($data);

        $datafile->move('upload/berkas', $filename);
        return redirect('pengaduan');
}

public function delete($id)
{
    $this->pengaduann->delete($id);
    session()->setFlashdata("message","Data berhasil dihapus");
    return $this->response->redirect('/pengaduan');
}


}