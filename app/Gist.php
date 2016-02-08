<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

class Gist implements Arrayable, Jsonable{

  protected $attributes = [];

  protected $dates = ['created_at', 'updated_at'];

  public function __construct($attributes = [])
  {
    $this->attributes = $attributes;
  }

  public function __get($name)
  {
    if(in_array($name, $this->dates))
    {
       return new Carbon($this->attributes[$name]);
    }

    if(in_array($name, $this->attributes))
    {
      return $this->attributes[$name];
    }
  }

  public function __set($name, $value)
  {
    if(in_array($name, $this->attributes))
    {
      $this->attributes[$name] = $value;
    }

    return $this;
  }

  public function toArray()
  {
    return $this->attributes;
  }

  public function toJson($options = 0)
  {
    return json_encode($this->toArray());
  }

}
