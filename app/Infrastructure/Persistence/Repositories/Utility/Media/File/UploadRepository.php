<?php

namespace App\Infrastructure\Persistence\Repositories\Utility\Media\File;

use App\Domain\Interfaces\Utility\Media\IUploadRepository;
use App\Infrastructure\Persistence\Eloquent\Utility\Media\File\AttachmentEloquent;
use App\Infrastructure\Persistence\Eloquent\Utility\Media\File\AttachmentRelationEloquent;
use App\Infrastructure\Persistence\Eloquent\Utility\Media\File\UploadEloquent;

class UploadRepository implements IUploadRepository {


    public function save(array $data){
        return UploadEloquent::create($data);
    }
    public function get_file(string $id){
        if($id!=null && $id != ""){
            $query = AttachmentEloquent::query();
            $query->select('*');
            $query->where('attachment_id', $id);
            $query->orWhere('row_id', $id);
            return $query->get()->toArray();
        }
        return "";
    }
    public function add_attachments($attachments, $table_name , $id){
        if(is_array($attachments) && $table_name != null){
            AttachmentRelationEloquent::where('worksheet_title', $table_name)->where('worksheet_id', $id)->delete();
            foreach ($attachments as $item) {
                AttachmentRelationEloquent::create([
                    'attachment_id' => $item,
                    'worksheet_title' => $table_name,
                    'worksheet_id' => $id
                ]);
            }
        }
        return "";
    }
    public function get_attachments($id,$table_name){
        if($id!=null && $id != ""){
            $query = AttachmentRelationEloquent::query();
            $query->select('*');
            $query->join('attachments','attachments.attachment_id', '=', 'attachments_relation.attachment_id');
            $query->where('attachments_relation.worksheet_id', $id);
            $query->where('attachments_relation.worksheet_title', $table_name);
            return $query->get()->toArray();
        }
        return "";
    }
}
