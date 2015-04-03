# FrontendUser

## FrontendUserLogin

**simple example**
```
#!php

// load login / logout module
$ful = $modules->get('FrontendUserLogin');

// simple login
echo $ful->login("{$config->urls->root}login");

// logout
echo $ful->logout("{$config->urls->root}login");
```

**advanced usage**

## FrontendUserRegister

**simple example**
```
#!php

// load register module
$fur = $modules->get('FrontendUserRegister');

// simple register 
echo $fur->register("{$config->urls->root}login");
```

**advanced usage**
