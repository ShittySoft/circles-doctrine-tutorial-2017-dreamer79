<?php

namespace Authentication\Entity;

use Authentication\Entity\User;

class CSVDataSource {
    const DATA_FILE_NAME = '/tmp/users.csv';
    private $fileData= array();
    
    private $file= null;
    
    public function __construct() {
        
    }
    
    public function __destruct() {
        if ($this->file !== null) {
            fclose($this->file);
        }
    }
    
    public function getByEmail($email) {
        
        if (empty($this->fileData)) {
            if ($this->file === null) {
                $this->file= fopen(self::DATA_FILE_NAME,'rw+');
            }
                fseek($this->file, 0);
        
            while ($line= fgetcsv($this->file)) {
                $this->fileData[$line[0]]= new User($line[0], $line[1]);
            }
            fclose($this->file);
            $this->file=null;
        }
        
        
        var_dump($this->fileData);
        if (isset($this->fileData[$email])) {
            return $this->fileData[$email];
        }
        
        return null;
    }
    
    public function saveUser(User $User) {
        if (!empty($this->fileData[$User->email])) {
            throw new Exception('user already exists');
        }
        
        if ($this->file === null) {
            $this->file= fopen(self::DATA_FILE_NAME,'a');
        }
        
        fseek($this->file, SEEK_END);
        $fields= array(
            $User->email,
            $User->password
        );
                
        fputcsv($this->file, $fields);
        fclose($this->file);
        $this->file= null;
    }
    
}