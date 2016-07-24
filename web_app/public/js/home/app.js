var app = angular.module('HomeApp',[]);

app.controller('TeamCtrl', function(){
    this.title = "Our Team Member";
    this.modalTitle ="個 人 介 紹";
    this.members = group;
});
app.controller('PictureCtrl', function(){
    this.title = "Our Work Picture";
    this.more = "View More Items";
    this.images = pictures;
});

var pictures = [
    "http://lorempixel.com/950/600/business/1",
    "http://lorempixel.com/950/600/business/2",
    "http://lorempixel.com/950/600/business/3",
    "http://lorempixel.com/950/600/business/3",
    "http://lorempixel.com/950/600/business/4"
];

var group =
[{
    "name"  : "范家禎",
    "class" : "四子三丙",
    "number": "1102105339",
    "text": {
        "content": "這是內容1"
    },
    "images": {
        "profile_picture":"/web_app/public/images/team_3.jpg"
    }
},
{
    "name"  : "洪獻謚",
    "class" : "四子三丙",
    "number": "1102105308",
    "text": {
        "content": "這是內容2"
    },
    "images": {
        "profile_picture":"/web_app/public/images/team_1.jpg"
    }
},
{
    "name"  : "郭俊宏",
    "class" : "四子三丙",
    "number": "1102105330",
    "text": {
        "content": "這是內容3"
    },
    "images": {
        "profile_picture":"/web_app/public/images/team_2.jpg"
    }
},
{
    "name"  : "陳毅軒",
    "class" : "四子三丙",
    "number": "1102105314",
    "text": {
        "content": "這是內容4"
    },
    "images": {
        "profile_picture":"/web_app/public/images/team_4.jpg"
    }
},
{
    "name"  : "張銘家",
    "class" : "四子三丙",
    "number": "1102105352",
    "text": {
        "content": "這是內容5"
    },
    "images": {
        "profile_picture":"/web_app/public/images/team_5.jpg"
    }
},
{
    "name"  : "林志紘",
    "class" : "四子四丙",
    "number": "1101105313",
    "text": {
        "content": "這是內容6"
    },
    "images": {
        "profile_picture":"http://lorempixel.com/600/750/business/6"
    }
}];
