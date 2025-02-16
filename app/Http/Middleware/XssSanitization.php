<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;

class XssSanitization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $input = $request->all();

        array_walk_recursive($input, function(&$input) {
             $allowed = '<div><span><pre><p><br><hr><hgroup><h1><h2><h3><h4><h5><h6><ul><ol><li><dl><dt><dd><strong><em><b><i><u><img><a><abbr><address><blockquote><area><audio><video><form><fieldset><label><input><textarea><caption><table><tbody><td><tfoot><th><thead><tr><iframe><align><alink><alt><bgcolor><border><cellpadding><cellspacing><class><color><cols><colspan><coords><dir><face><height><hspace><lang><marginheight><marginwidth><multiple><nohref><noresize><noshade><nowrap><ref><rel><rev><rows><rowspan><scrolling><shape><summary><tabindex><title><usemap><valign><value><vlink><vspace><width>';
            $input = strip_tags($input, $allowed);
        });

        $request->merge($input);

        return $next($request);
    }
}
