var nome, surname, email, emailc, username, password, passwordc, birthdate, sex, lblsex, phone, tips;
var elementi = [nome, surname, email, emailc, username, password, passwordc, birthdate];
var n = elementi.length;

function AggiornaVariabili()
{
    nome = document.inserimento.f0;
    surname = document.inserimento.f1;
    email = document.inserimento.f2;
    emailc = document.inserimento.EmailC;
    password = document.inserimento.f3;
    passwordc = document.inserimento.PasswordC;
    birthdate = document.inserimento.f4;
    sex = document.inserimento.f5;
    lblsex = document.getElementsByName('lblSex');
    username = document.inserimento.f6;
    phone = document.inserimento.f7;
    
    tips = document.getElementsByName('Tips');

    elementi = [nome, surname, email, emailc, username, password, passwordc, birthdate];
    
}


function ValidateData()
{
    AggiornaVariabili();    
    var flag=false; 
    for(var i=0;i<n;i++)
    {
        if(elementi[i].value==""){elementi[i].id = "error";flag = true;}
        else
            elementi[i].id = "";
    }

    if(emailc.value!=email.value){emailc.id = "error";flag = true;}
        
    if(passwordc.value!=password.value){passwordc.id = "error";flag = true;}
        

    //Casi Particolari
    if(sex.value==""){lblsex[0].id = "c";lblsex[1].id = "c";flag = true;}
    else
    {
        lblsex[0].id = "";
        lblsex[1].id = "";
    }
    
    if(!flag)
        document.inserimento.submit();
}

function Reset()
{
    AggiornaVariabili();

    for(var i=0;i<n;i++)
    {
        elementi[i].id = "";
        elementi[i].value = "";
    }

    phone.value = "";

    lblsex[0].id = "";
    lblsex[1].id = "";
    sex[0].checked = false;
    sex[1].checked = false;
}