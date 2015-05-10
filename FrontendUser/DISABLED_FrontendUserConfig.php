<?php
class FrontendUserConfig extends ModuleConfig {
  public function getDefaults() {
    return array(
      'subject' => "Email address pre-validation",
      'content' => "Validation token: {token}\n{url}?registerToken={token}",
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