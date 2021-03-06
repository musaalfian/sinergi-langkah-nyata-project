<?php

namespace App\Controllers;

use App\Models\MInnovation;
use App\Models\MProjectImpact;
use App\Models\MTagline;
use App\Models\MTeam;
use App\Models\MTestimonial;
use App\Models\MUniqueness;



class Innovation extends BaseController
{
    protected $MInnovation;
    protected $MProjectImpact;
    protected $MTagline;
    protected $MTeam;
    protected $MTestimonial;
    protected $MUniqueness;

    public function __construct()
    {
        $this->MInnovation = new MInnovation();
        $this->MProjectImpact = new MProjectImpact();
        $this->MTagline = new MTagline();
        $this->MTeam = new MTeam();
        $this->MTestimonial = new MTestimonial();
        $this->MUniqueness = new MUniqueness();
        $this->db = \Config\Database::connect();
        // $UsersModel = new \Myth\Auth\Models\UserModel();
    }
    public function innovation()
    {
        $innovation = $this->MInnovation->findAll();
        $data = [
            'title' => 'Innovation | Admin - Sinergi Langkah Nyata',
            'innovation'    => $innovation
        ];
        return view('pages/admin/innovation', $data);
    }
    public function addInnovation()
    {
        $data = [
            'title' => 'Innovation | Admin - Sinergi Langkah Nyata',
        ];
        return view('pages/admin/add-innovation', $data);
    }
    public function saveAddInnovation()
    {

        //insert innovation
        $name = $this->request->getVar('name');
        $description = $this->request->getVar('description');
        //get innovation's image
        $img_innovation = $this->request->getFile('img_innovation');
        // is upload?
        // dd($img_innovation);
        if ($img_innovation->getError() != 4) {
            // move image file to folder image
            $name_img_innovation = $img_innovation->getRandomName();
            $img_innovation->move('assets/images/innovation', $name_img_innovation);
        } else {
            $name_img_innovation = null;
        }
        $innovation = [
            'name_innovation'   => $name,
            'description_innovation' => $description,
            'image_innovation'  => $name_img_innovation
        ];
        $this->MInnovation->insert($innovation);
        $id_innovation = $this->db->InsertID();

        //insert uniquqeness//
        //get value
        $get_uniq = $this->request->getVar('uniq');
        // explode 
        $uniq_explode = (explode(";", $get_uniq));
        // looping for uniqueness explode
        foreach ($uniq_explode as $uniq_explode) {
            $uniq_explode_data = trim(substr(trim($uniq_explode), 2));
            // is empty
            if (strlen($uniq_explode_data) != 0) {
                $uniqueness = (explode(":", $uniq_explode_data));
            } else {
                break;
            }
            // split name and desc
            if (count($uniqueness) == 1) {
                $description_uniq =  null;
            } else {
                $description_uniq =  trim($uniqueness[1]);
            }
            // dd(count($uniqueness));

            $data_uniq = [
                'id_innovation' => $id_innovation,
                'name_uniqueness'    => trim($uniqueness[0]),
                'description_uniqueness'    => $description_uniq
            ];
            $this->MUniqueness->insert($data_uniq);
        }
        //insert project impact//
        //get value
        $get_project = $this->request->getVar('projectInput');
        //explde
        $project_explode = (explode(";", $get_project));
        // looping for project impact explode
        // dd($project_explode);
        foreach ($project_explode as $project_explode) {
            $project_explode_data = trim(substr(trim($project_explode), 2));
            // is empty
            if (strlen($project_explode_data) != 0) {
                $project = (explode(":", $project_explode_data));
            } else {
                break;
            }
            // split name and desc
            // $project = (explode(":", $project_explode_data));
            if (count($project) == 1) {
                $description_project =  null;
            } else {
                $description_project =  trim($project[1]);
            }
            $data_project_impact = [
                'id_innovation' => $id_innovation,
                'name_project_impact'    => trim($project[0]),
                'description_project_impact'    => $description_project,
                'category'    => $this->request->getVar('project')
            ];
            // dd($data_project_impact);
            $this->MProjectImpact->insert($data_project_impact);
        }
        return redirect()->to('/innovation/innovation');
    }
    public function detailInnovation($id_innovation)
    {
        $innovation = $this->MInnovation->find($id_innovation);
        $uniq = $this->MUniqueness->where('id_innovation', $id_innovation)->findAll();
        $project = $this->MProjectImpact->where('id_innovation', $id_innovation)->findAll();
        $data = [
            'title' => 'Innovation Detail | Admin - Sinergi Langkah Nyata',
            'innovation'    => $innovation,
            'uniq'    => $uniq,
            'project'    => $project,
        ];
        return view('pages/admin/detail-innovation', $data);
    }
    public function editInnovation($id_innovation)
    {
        session();
        $validation = \Config\Services::validation();
        $innovation = $this->MInnovation->find($id_innovation);
        //uniqueness
        $uniq = $this->MUniqueness->where('id_innovation', $id_innovation)->findAll();
        $i = 1;
        foreach ($uniq as $uniq) {
            $uniqueness[] = $i++ . ". " . $uniq['name_uniqueness'] . ": " . $uniq['description_uniqueness'] . "; \n";
        }
        //project
        $project_data = $this->MProjectImpact->where('id_innovation', $id_innovation)->findAll();
        $j = 1;
        foreach ($project_data as $data) {
            $project[] = $j++ . ". " . $data['name_project_impact'] . ": " . $data['description_project_impact'] . "; \n";
        }
        // dd($data);
        $data = [
            'title' => 'Innovation Edit | Admin - Sinergi Langkah Nyata',
            'innovation'    => $innovation,
            'uniq'    =>  $uniqueness,
            'project'    => $project,
            'validation'    => $validation,
            'category_project'    => $project_data[0]['category'],

        ];
        return view('pages/admin/edit-innovation', $data);
    }
    public function saveEditInnovation($id_innovation)
    {
        if (!$this->validate([
            'uniqueness'      => 'required',
            'project_impact'    => 'required',
        ])) {
            return redirect()->to('/innovation/editInnovation/' . $id_innovation)->withInput();
        }
        //insert innovation
        $name = $this->request->getVar('name');
        $description = $this->request->getVar('description');
        //get innovation's image
        $img_innovation = $this->request->getFile('img_innovation');
        $img_innovation_old = $this->request->getVar('image_old');
        // is upload?
        // dd($img_innovation_old);
        if ($img_innovation->getError() != 4) {
            // move image file to folder image
            $name_img_innovation = $img_innovation->getRandomName();
            $img_innovation->move('assets/images/innovation');
            unlink('assets/images/innovation/' . $img_innovation_old);
        } else {
            $name_img_innovation = $img_innovation_old;
        }
        $innovation = [
            'name_innovation'   => $name,
            'description_innovation' => $description,
            'image_innovation'  => $name_img_innovation
        ];
        $this->MInnovation->update($id_innovation, $innovation);

        //insert uniquqeness//
        $this->MUniqueness->where('id_innovation', $id_innovation)->delete();
        //get value
        $get_uniq = $this->request->getVar('uniqueness');
        // explode 
        $uniq_explode = (explode(";", $get_uniq));
        // looping for uniqueness explode
        foreach ($uniq_explode as $uniq_explode) {
            $uniq_explode_data = trim(substr(trim($uniq_explode), 2));
            // is empty
            if (strlen($uniq_explode_data) != 0) {
                $uniqueness = (explode(":", $uniq_explode_data));
            } else {
                break;
            }
            // split name and desc
            if (count($uniqueness) == 1) {
                $description_uniq =  null;
            } else {
                $description_uniq =  trim($uniqueness[1]);
            }
            // dd(count($uniqueness));

            $data_uniq = [
                'id_innovation' => $id_innovation,
                'name_uniqueness'    => trim($uniqueness[0]),
                'description_uniqueness'    => $description_uniq
            ];
            $this->MUniqueness->insert($data_uniq);
        }
        // dd($uniqueness);

        //insert project impact//
        $this->MProjectImpact->where('id_innovation', $id_innovation)->delete();
        //get value
        $get_project = $this->request->getVar('project_impact');
        //explde
        $project_explode = (explode(";", $get_project));
        // looping for project impact explode
        foreach ($project_explode as $project_explode) {
            $project_explode_data = trim(substr(trim($project_explode), 2));
            // is empty
            if (strlen($project_explode_data) != 0) {
                $uniqueness = (explode(":", $project_explode_data));
            } else {
                break;
            }
            // split name and desc
            $project = (explode(":", $project_explode_data));
            if (count($project) == 1) {
                $description_project =  null;
            } else {
                $description_project =  trim($project[1]);
            }
            $data_project_impact = [
                'id_innovation' => $id_innovation,
                'name_project_impact'    => trim($project[0]),
                'description_project_impact'    => $description_project,
                'category'    => $this->request->getVar('project')
            ];
            $this->MProjectImpact->insert($data_project_impact);
        }
        return redirect()->to('/innovation/innovation');
    }
    public function deleteInnovation($id_innovation)
    {
        $img_innovation = $this->MInnovation->where('id_innovation', $id_innovation)->findColumn('image_innovation');
        // dd($img_innovation);
        unlink('assets/images/innovation/' . $img_innovation[0]);
        $this->MInnovation->delete($id_innovation);
        return redirect()->to('/innovation/innovation');
    }
}