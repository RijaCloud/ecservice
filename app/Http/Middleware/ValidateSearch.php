<?php

namespace App\Http\Middleware;

use Closure;

class ValidateSearch
{
    private $all = false;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->has('sv')) {
            $this->all = false;
            if(is_array($request->get('sv'))) {

                $allowed_filter = ['oil','accessory','garage','part'];
                $wanted = array_intersect($allowed_filter,$request->get('sv'));
                $request->session()->put('sv-wanted',$wanted);

            }  else {

                $wanted = $request->get('sv');
                $request->session()->put('sv-wanted',$wanted);

            }

            if(empty($wanted)) {
                $this->all = true;
            }
        } else {
            $this->all = true;
        }
        $commune = $request->get('commune') ? $request->get('commune') : "";
        $request->session()->put('sv',$this->all);
        $request->session()->put('commune',$commune);
        return $next($request);
    }
}
