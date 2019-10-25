var requirejs = require('requirejs');
var fs = require('fs');


var obj;

if (fs.existsSync(`${__dirname}/../../public/resultsPost.json`)) {
    fs.readFile(`${__dirname}/../../public/resultsPost.json`, 'utf8', function (err, data) {
        if (err) throw err;
        obj = JSON.parse(data);

        var values = Object.values(obj);

        var acceptedArray = [
            "user_id",
            "slug",
            "title",
            "subtitle",
            "meta_desc",
            "post_body",
            "use_view_file",
            "posted_at",
            "is_published",
            "image_large",
            "image_medium",
            "image_thumbnail",
            "created_at",
            "updated_at",
            "short_description",
            "seo_title"
        ];

        let sql = "INSERT INTO blog_etc_posts(" + acceptedArray.join(',') + ")" +
            "VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

        requirejs(['mysql'],
            function (mysql) {
                //foo and bar are loaded according to requirejs
                //config, but if not found, then node's require
                //is used to load the module.
            });

        let mysql = require('mysql');
        var connection = mysql.createConnection({
            host: 'localhost',
            user: 'root',
            password: '',
            database: 'muzmatch_blog'
        });

        connection.connect();

        connection.query(sql, values, (err, results, fields) => {
            if (err) {
                return console.error(err.message);
            }
            // get inserted id
            console.log('Id:' + results.insertId);
        });

        connection.end();

    });
}

if (fs.existsSync(`${__dirname}/../../public/results.json`)) {
    fs.readFile(`${__dirname}/../../public/results.json`, 'utf8', function (err, data) {
        if (err) throw err;
        obj = JSON.parse(data);

        var values = Object.values(obj);

        var acceptedArray = [
            "blog_etc_post_id",
            "user_id",
            "ip",
            "author_name",
            "comment",
            "approved",
            "author_email",
            "author_website",
            "created_at",
            "updated_at",
            "comment_comments"
        ];

        let sql = "INSERT INTO blog_etc_comments(" + acceptedArray.join(',') + ")" +
            "VALUES(?,?,?,?,?,?,?,?,?,?,?)";

        requirejs(['mysql'],
            function (mysql) {
                //foo and bar are loaded according to requirejs
                //config, but if not found, then node's require
                //is used to load the module.
            });

        let mysql = require('mysql');
        var connection = mysql.createConnection({
            host: 'localhost',
            user: 'root',
            password: '',
            database: 'muzmatch_blog'
        });

        connection.connect();

        connection.query(sql, values, (err, results, fields) => {
            if (err) {
                return console.error(err.message);
            }
            // get inserted id
            console.log('Id:' + results.insertId);
        });

        connection.end();

    });
}