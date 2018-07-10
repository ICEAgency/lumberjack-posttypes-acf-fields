<?php

namespace IceAgency\PostTypeFields\AcfFields;

use IceAgency\PostTypeFields\AcfFields\Field;

use Exception;

class WysiwygField extends Field
{
    public $type = 'wysiwyg';
    public $tabs = 'all';
    public $toolbar = 'full';
    public $media_upload = 0;

    public function withTabs($tab_perference) {
        if (!in_array($tab_perference, [
            'all',
            'visual',
            'text'
        ])) {
            throw new Exception('The withTabs() method only allows the following options: all, visual or text.');
        }

        $this->tabs = $tab_perference;
        return $this;
    }

    public function withToolbar($toolbar_perference) {
        if (!in_array($toolbar_perference, [
            'full',
            'basic'
        ])) {
            throw new Exception('The withToolbar() method only allows the following options: full or basic.');
        }

        $this->toolbar = $toolbar_perference;
        return $this;
    }

    public function canUploadMedia() {
        $this->media_upload = 1;
        return $this;
    }

    public function toArray() : array {
        $data = parent::toArray();

        if ($this->tabs) {
            $data['tabs'] = $this->tabs;
        }

        if ($this->toolbar) {
            $data['toolbar'] = $this->toolbar;
        }

        $data['media_upload'] = $this->media_upload;

        return $data;
    }
}