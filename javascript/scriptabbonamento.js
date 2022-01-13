var startdate, finishdate;
var elementi = [startdate, finishdate];
var n = elementi.length;

function AggiornaVariabili()
{
    startdate = document.include.f0;
    finishdate = document.include.f1;

    elementi = [startdate, finishdate];
}

var f=false;
function ValidateData()
{
    AggiornaVariabili();

    if(f)
    {
        document.include.action = 'EliminaServizi.php';
        elementi[1].value=1;
    }
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

function RimuoviAbbonamento()
{
    document.rimuovi.submit();
}