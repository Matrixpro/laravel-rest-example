<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Laravel REST API Example Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=PT+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@10.7.2/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@10.7.2/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
            </style>

    <script>
        var baseUrl = "http://rest.local";
        var useCsrf = Boolean(1);
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("vendor/scribe/js/tryitout-3.23.0.js") }}"></script>

    <script src="{{ asset("vendor/scribe/js/theme-default-3.23.0.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("vendor/scribe/images/navbar.png") }}" alt="navbar-image" />
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                                                                            <ul id="tocify-header-0" class="tocify-header">
                    <li class="tocify-item level-1" data-unique="introduction">
                        <a href="#introduction">Introduction</a>
                    </li>
                                            
                                                                    </ul>
                                                <ul id="tocify-header-1" class="tocify-header">
                    <li class="tocify-item level-1" data-unique="authenticating-requests">
                        <a href="#authenticating-requests">Authenticating requests</a>
                    </li>
                                            
                                                </ul>
                    
                    <ul id="tocify-header-2" class="tocify-header">
                <li class="tocify-item level-1" data-unique="auth">
                    <a href="#auth">Auth</a>
                </li>
                                    <ul id="tocify-subheader-auth" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="auth-POSTapi-login">
                        <a href="#auth-POSTapi-login">API Login</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="auth-POSTapi-register">
                        <a href="#auth-POSTapi-register">POST api/register</a>
                    </li>
                                                    </ul>
                            </ul>
                    <ul id="tocify-header-3" class="tocify-header">
                <li class="tocify-item level-1" data-unique="vehicles">
                    <a href="#vehicles">Vehicles</a>
                </li>
                                    <ul id="tocify-subheader-vehicles" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="vehicles-GETapi-vehicles">
                        <a href="#vehicles-GETapi-vehicles">List all vehicles</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="vehicles-DELETEapi-vehicles--id-">
                        <a href="#vehicles-DELETEapi-vehicles--id-">Delete a vehicle</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="vehicles-POSTapi-vehicles">
                        <a href="#vehicles-POSTapi-vehicles">Create a vehicle</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="vehicles-PUTapi-vehicles--vehicle-">
                        <a href="#vehicles-PUTapi-vehicles--vehicle-">Put a vehicle</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="vehicles-GETapi-vehicles--id-">
                        <a href="#vehicles-GETapi-vehicles--id-">Get a vehicle</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="vehicles-PATCHapi-vehicles--vehicle-">
                        <a href="#vehicles-PATCHapi-vehicles--vehicle-">Patch a vehicle</a>
                    </li>
                                                    </ul>
                            </ul>
        
                        
            </div>

            <ul class="toc-footer" id="toc-footer">
                            <li><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                            <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
                    </ul>
        <ul class="toc-footer" id="last-updated">
        <li>Last updated: February 13 2022</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<p>Documentation</p>
<p>This documentation aims to provide all the information you need to work with our API.</p>
<aside>As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).</aside>
<blockquote>
<p>Base URL</p>
</blockquote>
<pre><code class="language-yaml">http://rest.local</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>This API is authenticated by sending an <strong><code>Authorization</code></strong> header with the value <strong><code>"Bearer {ACCESS_TOKEN}"</code></strong>.</p>
<p>All authenticated endpoints are marked with a <code>requires authentication</code> badge in the documentation below.</p>
<p>You can retrieve your token by registering a new account or log in with an existing one using the Auth API endpoints.</p>

        <h1 id="auth">Auth</h1>

    <p>Login or register for a new account to get your auth token</p>

            <h2 id="auth-POSTapi-login">API Login</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-login">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://rest.local/api/login" \
    --header "Authorization: Bearer {ACCESS_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"Jack Black\",
    \"email\": \"jack@example.com\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://rest.local/api/login"
);

const headers = {
    "Authorization": "Bearer {ACCESS_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Jack Black",
    "email": "jack@example.com"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-login">
</span>
<span id="execution-results-POSTapi-login" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-login"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-login"></code></pre>
</span>
<span id="execution-error-POSTapi-login" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-login"></code></pre>
</span>
<form id="form-POSTapi-login" data-method="POST"
      data-path="api/login"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {ACCESS_TOKEN}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-login', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-login"
                    onclick="tryItOut('POSTapi-login');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-login"
                    onclick="cancelTryOut('POSTapi-login');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-login" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/login</code></b>
        </p>
                <p>
            <label id="auth-POSTapi-login" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTapi-login"
                                                                data-component="header"></label>
        </p>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="name"
               data-endpoint="POSTapi-login"
               value="Jack Black"
               data-component="body" hidden>
    <br>
<p>Your name.</p>
        </p>
                <p>
            <b><code>email</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="email"
               data-endpoint="POSTapi-login"
               value="jack@example.com"
               data-component="body" hidden>
    <br>
<p>Your email.</p>
        </p>
        </form>

            <h2 id="auth-POSTapi-register">POST api/register</h2>

<p>
</p>



<span id="example-requests-POSTapi-register">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://rest.local/api/register" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"Jack Black\",
    \"email\": \"jack@example.com\",
    \"password\": \"password\",
    \"confirm_password\": \"password\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://rest.local/api/register"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Jack Black",
    "email": "jack@example.com",
    "password": "password",
    "confirm_password": "password"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-register">
</span>
<span id="execution-results-POSTapi-register" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-register"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-register"></code></pre>
</span>
<span id="execution-error-POSTapi-register" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-register"></code></pre>
</span>
<form id="form-POSTapi-register" data-method="POST"
      data-path="api/register"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-register', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-register"
                    onclick="tryItOut('POSTapi-register');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-register"
                    onclick="cancelTryOut('POSTapi-register');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-register" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/register</code></b>
        </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="name"
               data-endpoint="POSTapi-register"
               value="Jack Black"
               data-component="body" hidden>
    <br>
<p>Your name.</p>
        </p>
                <p>
            <b><code>email</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="email"
               data-endpoint="POSTapi-register"
               value="jack@example.com"
               data-component="body" hidden>
    <br>
<p>Your email.</p>
        </p>
                <p>
            <b><code>password</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="password"
               data-endpoint="POSTapi-register"
               value="password"
               data-component="body" hidden>
    <br>
<p>Your password.</p>
        </p>
                <p>
            <b><code>confirm_password</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="confirm_password"
               data-endpoint="POSTapi-register"
               value="password"
               data-component="body" hidden>
    <br>
<p>Confirm your password.</p>
        </p>
        </form>

        <h1 id="vehicles">Vehicles</h1>

    

            <h2 id="vehicles-GETapi-vehicles">List all vehicles</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-vehicles">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://rest.local/api/vehicles" \
    --header "Authorization: Bearer {ACCESS_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"per_page\": 10,
    \"search_for\": \"Honda\",
    \"search_in\": \"make\",
    \"order_direction\": \"ASC\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://rest.local/api/vehicles"
);

const headers = {
    "Authorization": "Bearer {ACCESS_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "per_page": 10,
    "search_for": "Honda",
    "search_in": "make",
    "order_direction": "ASC"
};

fetch(url, {
    method: "GET",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-vehicles">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 59
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 151,
            &quot;type&quot;: &quot;new&quot;,
            &quot;msrp&quot;: &quot;5193.11&quot;,
            &quot;year&quot;: 2022,
            &quot;make&quot;: &quot;Honda&quot;,
            &quot;model&quot;: &quot;Accord&quot;,
            &quot;miles&quot;: 43,
            &quot;vin&quot;: &quot;0&quot;,
            &quot;created_at&quot;: &quot;2022-02-11T20:33:08.000000Z&quot;
        },
        {
            &quot;id&quot;: 152,
            &quot;type&quot;: &quot;used&quot;,
            &quot;msrp&quot;: &quot;87406.24&quot;,
            &quot;year&quot;: 2022,
            &quot;make&quot;: &quot;Honda&quot;,
            &quot;model&quot;: &quot;Accord Hybrid&quot;,
            &quot;miles&quot;: 71172,
            &quot;vin&quot;: &quot;33159538&quot;,
            &quot;created_at&quot;: &quot;2022-02-11T20:33:08.000000Z&quot;
        },
        {
            &quot;id&quot;: 153,
            &quot;type&quot;: &quot;used&quot;,
            &quot;msrp&quot;: &quot;18393.45&quot;,
            &quot;year&quot;: 2022,
            &quot;make&quot;: &quot;Honda&quot;,
            &quot;model&quot;: &quot;Civic&quot;,
            &quot;miles&quot;: 2805,
            &quot;vin&quot;: &quot;81815790&quot;,
            &quot;created_at&quot;: &quot;2022-02-11T20:33:08.000000Z&quot;
        },
        {
            &quot;id&quot;: 154,
            &quot;type&quot;: &quot;used&quot;,
            &quot;msrp&quot;: &quot;20750.53&quot;,
            &quot;year&quot;: 2022,
            &quot;make&quot;: &quot;Honda&quot;,
            &quot;model&quot;: &quot;Civic Type R&quot;,
            &quot;miles&quot;: 68912829,
            &quot;vin&quot;: &quot;32&quot;,
            &quot;created_at&quot;: &quot;2022-02-11T20:33:08.000000Z&quot;
        },
        {
            &quot;id&quot;: 155,
            &quot;type&quot;: &quot;used&quot;,
            &quot;msrp&quot;: &quot;47393.72&quot;,
            &quot;year&quot;: 2022,
            &quot;make&quot;: &quot;Honda&quot;,
            &quot;model&quot;: &quot;CR-V&quot;,
            &quot;miles&quot;: 63162,
            &quot;vin&quot;: &quot;0&quot;,
            &quot;created_at&quot;: &quot;2022-02-11T20:33:08.000000Z&quot;
        },
        {
            &quot;id&quot;: 156,
            &quot;type&quot;: &quot;used&quot;,
            &quot;msrp&quot;: &quot;7315.29&quot;,
            &quot;year&quot;: 2022,
            &quot;make&quot;: &quot;Honda&quot;,
            &quot;model&quot;: &quot;CR-V Hybrid&quot;,
            &quot;miles&quot;: 9452,
            &quot;vin&quot;: &quot;17&quot;,
            &quot;created_at&quot;: &quot;2022-02-11T20:33:08.000000Z&quot;
        },
        {
            &quot;id&quot;: 157,
            &quot;type&quot;: &quot;new&quot;,
            &quot;msrp&quot;: &quot;72378.53&quot;,
            &quot;year&quot;: 2022,
            &quot;make&quot;: &quot;Honda&quot;,
            &quot;model&quot;: &quot;HR-V&quot;,
            &quot;miles&quot;: 305465390,
            &quot;vin&quot;: &quot;9&quot;,
            &quot;created_at&quot;: &quot;2022-02-11T20:33:08.000000Z&quot;
        },
        {
            &quot;id&quot;: 158,
            &quot;type&quot;: &quot;used&quot;,
            &quot;msrp&quot;: &quot;34724.91&quot;,
            &quot;year&quot;: 2022,
            &quot;make&quot;: &quot;Honda&quot;,
            &quot;model&quot;: &quot;Insight&quot;,
            &quot;miles&quot;: 8939,
            &quot;vin&quot;: &quot;6&quot;,
            &quot;created_at&quot;: &quot;2022-02-11T20:33:08.000000Z&quot;
        },
        {
            &quot;id&quot;: 159,
            &quot;type&quot;: &quot;used&quot;,
            &quot;msrp&quot;: &quot;59759.39&quot;,
            &quot;year&quot;: 2022,
            &quot;make&quot;: &quot;Honda&quot;,
            &quot;model&quot;: &quot;Odyssey&quot;,
            &quot;miles&quot;: 897250015,
            &quot;vin&quot;: &quot;71&quot;,
            &quot;created_at&quot;: &quot;2022-02-11T20:33:08.000000Z&quot;
        },
        {
            &quot;id&quot;: 160,
            &quot;type&quot;: &quot;new&quot;,
            &quot;msrp&quot;: &quot;2172.39&quot;,
            &quot;year&quot;: 2022,
            &quot;make&quot;: &quot;Honda&quot;,
            &quot;model&quot;: &quot;Passport&quot;,
            &quot;miles&quot;: 48634011,
            &quot;vin&quot;: &quot;614959&quot;,
            &quot;created_at&quot;: &quot;2022-02-11T20:33:08.000000Z&quot;
        }
    ],
    &quot;path&quot;: &quot;http://rest.local/api/vehicles&quot;,
    &quot;per_page&quot;: 10,
    &quot;next_page_url&quot;: &quot;http://rest.local/api/vehicles?cursor=eyJpZCI6MTYwLCJfcG9pbnRzVG9OZXh0SXRlbXMiOnRydWV9&quot;,
    &quot;prev_page_url&quot;: null
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-vehicles" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-vehicles"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-vehicles"></code></pre>
</span>
<span id="execution-error-GETapi-vehicles" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-vehicles"></code></pre>
</span>
<form id="form-GETapi-vehicles" data-method="GET"
      data-path="api/vehicles"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {ACCESS_TOKEN}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-vehicles', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-vehicles"
                    onclick="tryItOut('GETapi-vehicles');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-vehicles"
                    onclick="cancelTryOut('GETapi-vehicles');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-vehicles" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/vehicles</code></b>
        </p>
                <p>
            <label id="auth-GETapi-vehicles" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETapi-vehicles"
                                                                data-component="header"></label>
        </p>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>per_page</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
                <input type="number"
               name="per_page"
               data-endpoint="GETapi-vehicles"
               value="10"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>search_for</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="search_for"
               data-endpoint="GETapi-vehicles"
               value="Honda"
               data-component="body" hidden>
    <br>
<p>Search term.</p>
        </p>
                <p>
            <b><code>search_in</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="search_in"
               data-endpoint="GETapi-vehicles"
               value="make"
               data-component="body" hidden>
    <br>
<p>Options: type, msrp, make, year, model, miles, vin, created_at, updated_at</p>
        </p>
                <p>
            <b><code>order_direction</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="order_direction"
               data-endpoint="GETapi-vehicles"
               value="ASC"
               data-component="body" hidden>
    <br>
<p>Options: ASC and DESC</p>
        </p>
        </form>

            <h2 id="vehicles-DELETEapi-vehicles--id-">Delete a vehicle</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-vehicles--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://rest.local/api/vehicles/1" \
    --header "Authorization: Bearer {ACCESS_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://rest.local/api/vehicles/1"
);

const headers = {
    "Authorization": "Bearer {ACCESS_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-vehicles--id-">
</span>
<span id="execution-results-DELETEapi-vehicles--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-vehicles--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-vehicles--id-"></code></pre>
</span>
<span id="execution-error-DELETEapi-vehicles--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-vehicles--id-"></code></pre>
</span>
<form id="form-DELETEapi-vehicles--id-" data-method="DELETE"
      data-path="api/vehicles/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {ACCESS_TOKEN}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-vehicles--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-vehicles--id-"
                    onclick="tryItOut('DELETEapi-vehicles--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-vehicles--id-"
                    onclick="cancelTryOut('DELETEapi-vehicles--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-vehicles--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/vehicles/{id}</code></b>
        </p>
                <p>
            <label id="auth-DELETEapi-vehicles--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="DELETEapi-vehicles--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="DELETEapi-vehicles--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the vehicle.</p>
            </p>
                    </form>

            <h2 id="vehicles-POSTapi-vehicles">Create a vehicle</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-vehicles">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://rest.local/api/vehicles" \
    --header "Authorization: Bearer {ACCESS_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"type\": \"new\",
    \"msrp\": \"189000.99\",
    \"make\": \"Honda\",
    \"year\": 2022,
    \"model\": \"Accord\",
    \"miles\": \"20000\",
    \"vin\": \"4Y1SL65848Z411439\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://rest.local/api/vehicles"
);

const headers = {
    "Authorization": "Bearer {ACCESS_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "type": "new",
    "msrp": "189000.99",
    "make": "Honda",
    "year": 2022,
    "model": "Accord",
    "miles": "20000",
    "vin": "4Y1SL65848Z411439"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-vehicles">
</span>
<span id="execution-results-POSTapi-vehicles" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-vehicles"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-vehicles"></code></pre>
</span>
<span id="execution-error-POSTapi-vehicles" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-vehicles"></code></pre>
</span>
<form id="form-POSTapi-vehicles" data-method="POST"
      data-path="api/vehicles"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {ACCESS_TOKEN}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-vehicles', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-vehicles"
                    onclick="tryItOut('POSTapi-vehicles');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-vehicles"
                    onclick="cancelTryOut('POSTapi-vehicles');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-vehicles" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/vehicles</code></b>
        </p>
                <p>
            <label id="auth-POSTapi-vehicles" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTapi-vehicles"
                                                                data-component="header"></label>
        </p>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>type</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="type"
               data-endpoint="POSTapi-vehicles"
               value="new"
               data-component="body" hidden>
    <br>
<p>The condition of the vehicle.</p>
        </p>
                <p>
            <b><code>msrp</code></b>&nbsp;&nbsp;<small>numeric</small>  &nbsp;
                <input type="text"
               name="msrp"
               data-endpoint="POSTapi-vehicles"
               value="189000.99"
               data-component="body" hidden>
    <br>
<p>The MSRP of the vehicle.</p>
        </p>
                <p>
            <b><code>make</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="make"
               data-endpoint="POSTapi-vehicles"
               value="Honda"
               data-component="body" hidden>
    <br>
<p>The make of the vehicle.</p>
        </p>
                <p>
            <b><code>year</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="year"
               data-endpoint="POSTapi-vehicles"
               value="2022"
               data-component="body" hidden>
    <br>
<p>The year of the vehicle.</p>
        </p>
                <p>
            <b><code>model</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="model"
               data-endpoint="POSTapi-vehicles"
               value="Accord"
               data-component="body" hidden>
    <br>
<p>The model of the vehicle.</p>
        </p>
                <p>
            <b><code>miles</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="miles"
               data-endpoint="POSTapi-vehicles"
               value="20000"
               data-component="body" hidden>
    <br>
<p>The miles of the vehicle.</p>
        </p>
                <p>
            <b><code>vin</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="vin"
               data-endpoint="POSTapi-vehicles"
               value="4Y1SL65848Z411439"
               data-component="body" hidden>
    <br>
<p>The VIN of the vehicle.</p>
        </p>
        </form>

            <h2 id="vehicles-PUTapi-vehicles--vehicle-">Put a vehicle</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-vehicles--vehicle-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://rest.local/api/vehicles/1" \
    --header "Authorization: Bearer {ACCESS_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"type\": \"new\",
    \"msrp\": 189000,
    \"make\": \"Honda\",
    \"year\": 2022,
    \"model\": \"Accord\",
    \"miles\": \"20000\",
    \"vin\": \"4Y1SL65848Z411439\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://rest.local/api/vehicles/1"
);

const headers = {
    "Authorization": "Bearer {ACCESS_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "type": "new",
    "msrp": 189000,
    "make": "Honda",
    "year": 2022,
    "model": "Accord",
    "miles": "20000",
    "vin": "4Y1SL65848Z411439"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-vehicles--vehicle-">
</span>
<span id="execution-results-PUTapi-vehicles--vehicle-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-vehicles--vehicle-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-vehicles--vehicle-"></code></pre>
</span>
<span id="execution-error-PUTapi-vehicles--vehicle-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-vehicles--vehicle-"></code></pre>
</span>
<form id="form-PUTapi-vehicles--vehicle-" data-method="PUT"
      data-path="api/vehicles/{vehicle}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {ACCESS_TOKEN}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-vehicles--vehicle-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-vehicles--vehicle-"
                    onclick="tryItOut('PUTapi-vehicles--vehicle-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-vehicles--vehicle-"
                    onclick="cancelTryOut('PUTapi-vehicles--vehicle-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-vehicles--vehicle-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/vehicles/{vehicle}</code></b>
        </p>
                <p>
            <label id="auth-PUTapi-vehicles--vehicle-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PUTapi-vehicles--vehicle-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>vehicle</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="vehicle"
               data-endpoint="PUTapi-vehicles--vehicle-"
               value="1"
               data-component="url" hidden>
    <br>

            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>type</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="type"
               data-endpoint="PUTapi-vehicles--vehicle-"
               value="new"
               data-component="body" hidden>
    <br>
<p>The condition of the vehicle.</p>
        </p>
                <p>
            <b><code>msrp</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="msrp"
               data-endpoint="PUTapi-vehicles--vehicle-"
               value="189000"
               data-component="body" hidden>
    <br>
<p>The MSRP of the vehicle.</p>
        </p>
                <p>
            <b><code>make</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="make"
               data-endpoint="PUTapi-vehicles--vehicle-"
               value="Honda"
               data-component="body" hidden>
    <br>
<p>The make of the vehicle.</p>
        </p>
                <p>
            <b><code>year</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="year"
               data-endpoint="PUTapi-vehicles--vehicle-"
               value="2022"
               data-component="body" hidden>
    <br>
<p>The year of the vehicle.</p>
        </p>
                <p>
            <b><code>model</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="model"
               data-endpoint="PUTapi-vehicles--vehicle-"
               value="Accord"
               data-component="body" hidden>
    <br>
<p>The model of the vehicle.</p>
        </p>
                <p>
            <b><code>miles</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="miles"
               data-endpoint="PUTapi-vehicles--vehicle-"
               value="20000"
               data-component="body" hidden>
    <br>
<p>The miles of the vehicle.</p>
        </p>
                <p>
            <b><code>vin</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="vin"
               data-endpoint="PUTapi-vehicles--vehicle-"
               value="4Y1SL65848Z411439"
               data-component="body" hidden>
    <br>
<p>The VIN of the vehicle.</p>
        </p>
        </form>

            <h2 id="vehicles-GETapi-vehicles--id-">Get a vehicle</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-vehicles--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://rest.local/api/vehicles/5" \
    --header "Authorization: Bearer {ACCESS_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://rest.local/api/vehicles/5"
);

const headers = {
    "Authorization": "Bearer {ACCESS_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-vehicles--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 58
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;success&quot;: true,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;created_at&quot;: &quot;2022-02-11T20:33:07.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2022-02-11T20:33:07.000000Z&quot;,
        &quot;type&quot;: &quot;used&quot;,
        &quot;msrp&quot;: &quot;51353.38&quot;,
        &quot;year&quot;: 2022,
        &quot;make&quot;: &quot;Acura&quot;,
        &quot;model&quot;: &quot;ILX&quot;,
        &quot;miles&quot;: 9539,
        &quot;vin&quot;: &quot;604676978&quot;
    },
    &quot;message&quot;: &quot;Vehicle retrieved.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-vehicles--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-vehicles--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-vehicles--id-"></code></pre>
</span>
<span id="execution-error-GETapi-vehicles--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-vehicles--id-"></code></pre>
</span>
<form id="form-GETapi-vehicles--id-" data-method="GET"
      data-path="api/vehicles/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {ACCESS_TOKEN}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-vehicles--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-vehicles--id-"
                    onclick="tryItOut('GETapi-vehicles--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-vehicles--id-"
                    onclick="cancelTryOut('GETapi-vehicles--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-vehicles--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/vehicles/{id}</code></b>
        </p>
                <p>
            <label id="auth-GETapi-vehicles--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETapi-vehicles--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="GETapi-vehicles--id-"
               value="5"
               data-component="url" hidden>
    <br>
<p>The ID of the vehicle.</p>
            </p>
                    </form>

            <h2 id="vehicles-PATCHapi-vehicles--vehicle-">Patch a vehicle</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PATCHapi-vehicles--vehicle-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PATCH \
    "http://rest.local/api/vehicles/1" \
    --header "Authorization: Bearer {ACCESS_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"make\": \"Honda\",
    \"year\": 2022,
    \"model\": \"Accord\",
    \"miles\": \"20000\",
    \"vin\": \"4Y1SL65848Z411439\",
    \"type\": \"new\",
    \"msrp\": 189000
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://rest.local/api/vehicles/1"
);

const headers = {
    "Authorization": "Bearer {ACCESS_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "make": "Honda",
    "year": 2022,
    "model": "Accord",
    "miles": "20000",
    "vin": "4Y1SL65848Z411439",
    "type": "new",
    "msrp": 189000
};

fetch(url, {
    method: "PATCH",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PATCHapi-vehicles--vehicle-">
</span>
<span id="execution-results-PATCHapi-vehicles--vehicle-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PATCHapi-vehicles--vehicle-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PATCHapi-vehicles--vehicle-"></code></pre>
</span>
<span id="execution-error-PATCHapi-vehicles--vehicle-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PATCHapi-vehicles--vehicle-"></code></pre>
</span>
<form id="form-PATCHapi-vehicles--vehicle-" data-method="PATCH"
      data-path="api/vehicles/{vehicle}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {ACCESS_TOKEN}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PATCHapi-vehicles--vehicle-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PATCHapi-vehicles--vehicle-"
                    onclick="tryItOut('PATCHapi-vehicles--vehicle-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PATCHapi-vehicles--vehicle-"
                    onclick="cancelTryOut('PATCHapi-vehicles--vehicle-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PATCHapi-vehicles--vehicle-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/vehicles/{vehicle}</code></b>
        </p>
                <p>
            <label id="auth-PATCHapi-vehicles--vehicle-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PATCHapi-vehicles--vehicle-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>vehicle</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="vehicle"
               data-endpoint="PATCHapi-vehicles--vehicle-"
               value="1"
               data-component="url" hidden>
    <br>

            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>make</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="make"
               data-endpoint="PATCHapi-vehicles--vehicle-"
               value="Honda"
               data-component="body" hidden>
    <br>
<p>The make of the vehicle.</p>
        </p>
                <p>
            <b><code>year</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
                <input type="number"
               name="year"
               data-endpoint="PATCHapi-vehicles--vehicle-"
               value="2022"
               data-component="body" hidden>
    <br>
<p>The year of the vehicle.</p>
        </p>
                <p>
            <b><code>model</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="model"
               data-endpoint="PATCHapi-vehicles--vehicle-"
               value="Accord"
               data-component="body" hidden>
    <br>
<p>The model of the vehicle.</p>
        </p>
                <p>
            <b><code>miles</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="miles"
               data-endpoint="PATCHapi-vehicles--vehicle-"
               value="20000"
               data-component="body" hidden>
    <br>
<p>The miles of the vehicle.</p>
        </p>
                <p>
            <b><code>vin</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="vin"
               data-endpoint="PATCHapi-vehicles--vehicle-"
               value="4Y1SL65848Z411439"
               data-component="body" hidden>
    <br>
<p>The VIN of the vehicle.</p>
        </p>
                <p>
            <b><code>type</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="type"
               data-endpoint="PATCHapi-vehicles--vehicle-"
               value="new"
               data-component="body" hidden>
    <br>
<p>The condition of the vehicle.</p>
        </p>
                <p>
            <b><code>msrp</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
                <input type="number"
               name="msrp"
               data-endpoint="PATCHapi-vehicles--vehicle-"
               value="189000"
               data-component="body" hidden>
    <br>
<p>The MSRP of the vehicle.</p>
        </p>
        </form>

    

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                            </div>
            </div>
</div>
</body>
</html>
