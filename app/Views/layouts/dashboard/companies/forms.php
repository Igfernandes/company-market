<?php

use App\Components\Private\Companies\Form\Content;
use App\Database\Entities\Companies\CompanyEntity;

Content::render(
    company: $company ?? new CompanyEntity()
);
