<?php
/**
 * Processwire 'FrontendUser' module
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
    /** @var object PW form object */
    protected $form = null;
        
    /** @var object PW user object */
    protected $userObj = null;
    
    /** @var string Redirect destination */
    protected $redirect = null;
    
    /** 
     * Render login form
     * @return html Rendered login form
     */
    public function render() {
        return $this->form->render();
    }

    public function loadCssJs() {
        $this->getCssJs("{$this}.css", 'styles');
        $this->getCssJs("{$this}.js", 'scripts');
    }
    
    protected function getCssJs($file, $type) {
        $custom = $this . '/' . $file;
        if (file_exists($this->config->paths->templates . $custom)) {
            $this->config->$type->add($this->config->urls->templates . $custom);
        }
        else {
            $defaultFile = "{$this->config->urls->FrontendUserLogin}{$type}/$file";
            $this->config->$type->add($defaultFile);
        }
    }
    
    /**
     * Set / get class attributes
     * @param string $key Attribute name
     * @param mixed $value Attribute value
     * @return mixed Attribute value
     */
    public function attr($key, $value = null) {
        if ($value === null) return $this->$key;
        $this->$key = $value;
    }
    
    /**
     * Process login form
     * @return boolean Not submitted (null), submitted with (false) or without errors (true)
     */
    protected function processForm() {
        $submitBtn = $this->form->find("type=submit")->first;
        
        if(!$this->input->post->{$submitBtn->name}) return null;    // form not submitted, end here...
        if(!$this->session->CSRF->hasValidToken())  $submitBtn->error($this->_('Form token invalid!'));
        $this->form->processInput($this->input->post);  // process form values
        $this->session->CSRF->resetToken(); // reset the token so no double posts happen
        
        foreach ($this->form as $field) {
            if (!empty($field->fulOption['callbackProcess'])) {
                $field->fulOption['callbackProcess']($field, $this);
            }
        }
        
        if (count($this->form->getErrors()))    return false;  // form submitted with errors
        return true;    // form submitted and processed without errors
    }
    
}