document
.getElementById(
"scheduleForm"
)

.addEventListener(

"submit",

function(e){

e.preventDefault();

let formData=
new FormData(
this
);

fetch(

"../../../ajax/schedule_article.php",

{

method:"POST",

body:formData

}

)

.then(

response=>response.text()

)

.then(

data=>{

document
.getElementById(
"result"
)
.innerHTML=data;

}

);

}

);