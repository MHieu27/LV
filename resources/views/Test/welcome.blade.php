<!doctype html>
<html>
<head>
    <title>Neovis.js Simple Example</title>
    <style type="text/css">
        html, body {
            font: 16pt arial;
        }

        #viz {
            width: 900px;
            height: 700px;
            border: 1px solid lightgray;
            font: 22pt arial;
        }
    </style>

<script src="https://unpkg.com/neovis.js@2.0.2/dist/neovis-without-dependencies.js"></script>
<script src="https://unpkg.com/neovis.js@2.0.2"></script>
</head>
<body onload="draw()">
<div id="viz"></div>
</body>

<script type="text/javascript">

    let neoViz;

    function draw() {
        const config = {
            containerId: "viz",
            neo4j: {
                serverUrl: "bolt://localhost:7687",
                serverUser: "neo4j",
                serverPassword: "password",
            },
            labels: {
                Person: {
                    label: "name",
                },
                Production:{
                    label: "title"
                }
            },
            relationships: {
                REVIEWED: {
                }
            },
/*             initialCypher: "MATCH p=()-[r:PROVIDER]->() RETURN p", */
            initialCypher: "MATCH p=()-[r:PURCHASE]->() RETURN p",
        };

        neoViz = new NeoVis.default(config);
        neoViz.render();
    }
</script>
</html>
