<?php
/**
 * Processwire 'FrontendUserRegisterEmailValidation' module configuration
 * 
 * Adds module configuration to the module
 * 
 * @author pwFoo
 * @since 2015-05-13
 * 
 * ProcessWire 2.x
 * Copyright (C) 2011 by Ryan Cramer
 * Licensed under GNU/GPL v2, see LICENSE.TXT
 *
 * http://www.processwire.com
 * http://www.ryancramer.com
 */
class FrontendUserRegisterEmailValidationConfig extends ModuleConfig {
    public function getDefaults() {
        return array(
          'subject' => "User registration e-mail address validation",
          'content' => "Please confirm your e-mail address to register an user account.",
        );
    }

    public function getInputfields() {
        $form = parent::getInputfields();

        $f = $this->modules->get('InputfieldMarkup');
        $f->value = '<h2>Email address pre-registration validation<h2>';
        $form->add($f);

        $f = $this->modules->get('InputfieldText');
        $f->attr('name', 'subject');
        $f->label = $this->_('Subject address validation email');
        $f->required = true;
        $form->add($f);

        $f = $this->modules->get('InputfieldTextarea');
        $f->attr('name', 'content');
        $f->label = $this->_('Content address validation email');
        $f->required = true;
        $form->add($f);

        return $form;
    }
}