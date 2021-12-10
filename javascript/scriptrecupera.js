var email;
var elementi = [email];
var n = elementi.length;

function AggiornaVariabili()
{
    email = document.recupera.f0;

    elementi = [email];
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
        document.recupera.submit();
}