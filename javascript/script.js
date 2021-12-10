var email, password;
var elementi = [email, password];
var n = elementi.length;

function AggiornaVariabili()
{
    email = document.login.f0;
    password = document.login.f1;

    elementi = [email, password];
}


function ValidateData()
{
    AggiornaVariabili();
    var flag=false;

    for(var i=0;i<n;i++)
    {
        if(elementi[i].value=="")
            {elementi[i].id = "error";flag = true;}
        else
            elementi[i].id = "";
    }

    if(!flag)
        document.login.submit();
}