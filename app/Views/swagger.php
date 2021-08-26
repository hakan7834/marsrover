<!-- HTML for static distribution bundle build -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Swagger UI</title>
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/swagger-ui-dist@3.12.1/swagger-ui.css">
    <style>
        html
        {
            box-sizing: border-box;
            overflow: -moz-scrollbars-vertical;
            overflow-y: scroll;
        }
        *,
        *:before,
        *:after
        {
            box-sizing: inherit;
        }

        body
        {
            margin:0;
            background: #fafafa;
        }
        .information-container .description .renderedMarkdown {
            text-align: right;
            width: 100%;
            font-size: 12px;
        }
        .information-container .description .renderedMarkdown a {
            font-size: 12px !important;
        }
    </style>
</head>

<body>
<div id="swagger-ui"></div>
<div style="display:none;text-align: center;font-size:20px;padding:30px;">Powered By <a href="https://hakanakhan.com" style="color:#242424;"> HAKAN AKHAN</a></div>
<script src="https://unpkg.com/swagger-ui-dist@3.12.1/swagger-ui-standalone-preset.js"></script>
<script src="https://unpkg.com/swagger-ui-dist@3.12.1/swagger-ui-bundle.js"></script>
<script>
    window.onload = function() {

        // Begin Swagger UI call region
        const ui = SwaggerUIBundle({
            url: window.location.protocol + "//" + window.location.host + "/swagger/v<?= $version; ?>/swagger.json",
            dom_id: '#swagger-ui',
            deepLinking: true,
            presets: [
                SwaggerUIBundle.presets.apis,
                SwaggerUIStandalonePreset
            ],
            layout: "StandaloneLayout"
        });

        // End Swagger UI call region
        window.ui = ui
    }
</script>
</body>
</html>
