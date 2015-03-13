# FrontendUser

## FrontendUserLogin

**simple example**
```
#!php

// load login / logout module
$ful = $modules->get('FrontendUserLogin');

// simple login
echo $ful->login("{$config->urls->root}login")->render();

// logout
echo $ful->logout("{$config->urls->root}login");
```

**advanced usage**
```
#!php

// Callback to modify values just before or after login via dynamic function
// optional login with email address instead of an username... (could also be done as username form field callback "process"! Just an example!!!)
$callback['preLogin'] = function ($fulObj) {
    // callback defined outside the module class, so $this and private class attributes won't work!
    // module object hand over as function param. Get / set attributes with the attr() method.
    $email = $fulObj->attr('form')->get('username')->value;
    $userObj = wire('users')->get("email={$email}");
    if ($userObj instanceof User)   $fulObj->attr('user', $userObj->name);
};

// Integrate LoginPersist module (manual mode) after sucessfully logged in
$callback['postLogin'] = function ($fulObj) {
    if ($fulObj->attr('result')) {
        wire('modules')->get('LoginPersist')->persist();
    }
};
```

```
#!php

// Define a form field with a process callback
/**
 * Username form field
 * @return object Username field
 */
protected function fieldUsername() {
    $field = $this->modules->get('InputfieldText');
    $field->label = $this->_('Username');
    $field->attr('id+name', 'username');
    $field->required = 1;
    // Set a "callbackProcess" to sanitize the input value or a "callbackPrepare" executed just before the field will be added to the form
    $field->fulOption = array(
        'callbackProcess' => function ($field) {
//      'callbackProcess' => function ($field, $obj) {    // to get module object also outside the module class use an additional param
            // callback defined inside the module class and $this will work here!
            $this->user = wire('sanitizer')->username($field->value);
        },
        'callbackPrepare' => function ($field) {
            // Your code here... will be executed before field added to form
        }
    );
    return $field;
}
```

## FrontendUserRegister

**simple example**
```
#!php

// load register module
$fur = $modules->get('FrontendUserRegister');

// simple register 
echo $fur->register("{$config->urls->root}login")->render();
```

**advanced usage**
```
#!php
//coming soon
```