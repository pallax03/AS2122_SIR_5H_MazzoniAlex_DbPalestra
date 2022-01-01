var startdate, finishdate;
var elementi = [startdate, finishdate];
var n = elementi.length;

function AggiornaVariabili()
{
    startdate = document.include.f0;
    finishdate = document.include.f1;

    elementi = [startdate, finishdate];
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
        document.include.submit();
}