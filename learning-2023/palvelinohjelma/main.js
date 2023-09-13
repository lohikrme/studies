console.log("Server-side program starting");

const express = require('express');
const app = express();
const PORT = 3000;

// baseurl: http://localhost:3000
// endpoint http://localhost:3000/
app.get('/', () => {
    // req = request object, res = response object
    // these parameters are those that come from the client
    // res.send vastaa asiakkaalle "ok"
    res.send("OK");
});

// endpoint: GET /pong
app.get('/ping', (req, res) => {
    res.send('pong');
});

// define middleware that parse json
app.use(express.json());
// endpoint: POST /data
app.post('/data', (req, res) => {
    // this endpoint receives data from client in "body"
    const password = "ldkgjsm";
    const body = req.body;
    let res_obj = { 
        password_ok: false,
        client_obj: body 
    }
    if (password == body.password) {
        console.log("password is correct");
        res_obj.password_ok = true;
    } else {
        console.log("password is wrong!");
    }
    res.json(res_obj);
});

// listen method from express.js starts the service
app.listen(PORT, () => console.log(`Listening on http://localhost:${PORT}`));