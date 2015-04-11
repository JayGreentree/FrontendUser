<?php
/**
 * Processwire 'FrontendUserLogin' module
 * 
 * Login and logout frontend users.
 * 
 * @author pwFoo
 * @since 2015-03-10
 * 
 * ProcessWire 2.x
 * Copyright (C) 2011 by Ryan Cramer
 * Licensed under GNU/GPL v2, see LICENSE.TXT
 *
 * http://www.processwire.com
 * http://www.ryancramer.com
 */

abstract class FrontendUser extends WireData implements Module {
    protected $userObj;
    protected $form;

    public function validate() {
        $this->form->fhProcessForm();
        return $this;
    }
    
    /**
     * Shortcut to build, validate, process and render form
     * @return html Rendered form
     */
    public function render($redirect = null) {
        $this->form()->validate()->process($redirect);
        return $this->renderForm();
    }

    /**
     * Render current form
     * @return html Rendered form
     */
    public function ___renderForm() {
        return $this->form->render();
    }
    
    public function attr($key, $value = null) {
        if ($value === null) return $this->$key;
        $this->$key = $value;
    }
    
    protected function buildForm($fields = null) {
        $this->form = $this->modules->get('FormHelper')->create();
        
        $fields = ($fields ? $fields : array('username', 'email', 'password'));
        foreach ($fields as $field) {
            if (is_string($field)) {
                $field = $this->$field();
            }
            $this->form->add($field);
        }
        $this->loadCssJs();         // Load CSS / JS custom or default files
    }
    
    protected function loadCssJs() {
        $this->getCssJs("{$this}.css", 'styles');
        $this->getCssJs("{$this}.js", 'scripts');
    }
    
    protected function getCssJs($file, $type) {
        $custom = $this . '/' . $file;
        if (file_exists($this->config->paths->templates . $custom)) {
            $file = $this->config->urls->templates . $custom;
        }
        else {
            $file = "{$this->config->urls->FrontendUserLogin}/$file";
        }
        $this->config->$type->add($file);
    }
}
