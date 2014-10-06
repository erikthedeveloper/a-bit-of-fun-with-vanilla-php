<?php

namespace spec\MyClasses\Validation;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ValidatorSpec extends ObjectBehavior
{
    //function it_validates_using_the_old_ugly_method()
    //{
    //    $data = [
    //        'email' => '',
    //        'password' => 'foobar'
    //    ];
    //    $rules = [
    //        'email'    => "/\w+/",
    //        'password' => "/\w+/"
    //    ];
    //    $this->validate($rules, $data)->shouldReturn(false);
    //}

    function it_validates_each_field_with_a_given_array_of_callables()
    {
        $data = [
            'email' => '',
            'password' => 'foobar'
        ];
        $rules = [
            'email'    => ['not_empty'],
            'password' => ['not_empty']
        ];
        $this->validate($rules, $data)->shouldReturn(false);
    }

    function it_validates_an_email_address()
    {
        $data = [
            'email' => 'joe@joe.com'
        ];
        $rules = [
            'email'    => ['email']
        ];
        $this->validate($rules, $data)->shouldReturn(true);
    }
}
