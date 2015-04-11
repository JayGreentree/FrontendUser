# FrontendUser

## FrontendUserLogin

**simple example**
```
#!php
// login
echo $modules->get('FrontendUserLogin')->render($redirectAfterLogin);

// register
echo $modules->get('FrontendUserRegister')->render($redirectAfterRegister);
```

**advanced usage**
```
#!php
$fu = $modules->get('FrontendUserLogin');
$fu->form();

// plugin here...

$fu->validate();
$fu->process($redirect);
$fu->renderForm();
```

## FrontendUserRegister

**simple example**
```
#!php
$fu = $modules->get('FrontendUserRegister');
$fu->render($redirectAfterRegister);
```

**advanced usage**
Add a default role to the user (plugin / PW hook).
```
#!php
$fu = $modules->get('FrontendUserRegister');
$form = $fu->form();

$fu->addHookBefore('saveUser', function($event) {
    $user = $event->object->attr('userObj');
    $user->addRole('superuser');
});

$content = $fu->validate()->process()->renderForm();
```

