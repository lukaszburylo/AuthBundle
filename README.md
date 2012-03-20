nBuryloAuthBundle
=================
## Installation

Installation depends on how your project is setup:

### Step 1: Installation

Add the following lines to your ``deps`` file

```
[nBuryloAuthBundle]
    git=http://github.com/lukaszburylo/AuthBundle.git
    target=/bundles/nBurylo/AuthBundle
    
```

Next, update your vendors by running:

``` bash
$ ./bin/vendors install
```

### Step 2: Configure the autoloader

Add the following entries to your autoloader:

``` php
<?php
// app/autoload.php

$loader->registerNamespaces(array(
    // ...
    
    'nBurylo'   => __DIR__.'/../vendor/bundles',
));
```

### Step 3: Enable the bundle

Finally, enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...

        new nBurylo\AuthBundle\nBuryloAuthBundle(),
    );
}
```

### Step 4: Configure routing
Add a floowing entries to your routing file ``app/config/routing.yml``

```
nBuryloAuthBundle:
    resource: "@nBuryloAuthBundle/Resources/config/routing.yml"

```

### Step 5: Configure security
Edit file ``app/config/security.yml``:
```
security:
    encoders:
        nBurylo\AuthBundle\Entity\User:
            algorithm: sha1
            encode_as_base64: false
            iterations: 1


    providers:
        chain_provider:
            providers: user_db
        user_db:
            entity: { class: nBurylo\AuthBundle\Entity\User, property: username }                      
                

    firewalls:
        login:
            pattern:  ^/auth/login$
            security: false
        secured_area:
            pattern:    ^/
            form_login:
                check_path: /auth/login_check
                login_path: /auth/login
            logout:
                path:    /auth/logout
                target:  /
```
