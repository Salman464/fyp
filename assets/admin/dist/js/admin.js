function searchForName() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("demo-foo-addrow");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

function showDetails(button, divToBlockOrHide) {
    var techniciansDetail = document.getElementById(divToBlockOrHide);
    techniciansDetail.style.display = "block";
    var buttonTogller = document.getElementById(button);
    buttonTogller.style.display = "none";
}

function filter() {
    var input, filter, table, table1, table2, table3, table4, table5, tr, tr1, tr2, tr3, tr4, tr5, td, i, txtValue;
    input = document.getElementById("dept");
    filter = input.value.toUpperCase();
    if (filter !== "ALL") {
        table = document.getElementById("allComplaintsTable");
        table1 = document.getElementById("pendingComplaints");
        table2 = document.getElementById("processingComplaints");
        table3 = document.getElementById("productWaitingComplaints");
        table4 = document.getElementById("resolveComplaints");
        table5 = document.getElementById("rejectComplaints");
        tr = table.getElementsByTagName("tr");
        tr1 = table1.getElementsByTagName("tr");
        tr2 = table2.getElementsByTagName("tr");
        tr3 = table3.getElementsByTagName("tr");
        tr4 = table4.getElementsByTagName("tr");
        tr5 = table5.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            // Change to department row Number!
            td = tr[i].getElementsByTagName("td")[3];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
        for (i = 0; i < tr1.length; i++) {
            // Change to department row Number!
            td = tr1[i].getElementsByTagName("td")[3];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr1[i].style.display = "";
                } else {
                    tr1[i].style.display = "none";
                }
            }
        }
        for (i = 0; i < tr2.length; i++) {
            // Change to department row Number!
            td = tr2[i].getElementsByTagName("td")[3];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr2[i].style.display = "";
                } else {
                    tr2[i].style.display = "none";
                }
            }
        }
        for (i = 0; i < tr3.length; i++) {
            // Change to department row Number!
            td = tr3[i].getElementsByTagName("td")[3];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr3[i].style.display = "";
                } else {
                    tr3[i].style.display = "none";
                }
            }
        }
        for (i = 0; i < tr4.length; i++) {
            // Change to department row Number!
            td = tr4[i].getElementsByTagName("td")[3];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr4[i].style.display = "";
                } else {
                    tr4[i].style.display = "none";
                }
            }
        }
        for (i = 0; i < tr5.length; i++) {
            // Change to department row Number!
            td = tr5[i].getElementsByTagName("td")[3];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr5[i].style.display = "";
                } else {
                    tr5[i].style.display = "none";
                }
            }
        }
    } else {
        for (i = 0; i < 5; i++) {
            tr[i].style.display = "";
            tr1[i].style.display = "";
            tr2[i].style.display = "";
            tr3[i].style.display = "";
            tr4[i].style.display = "";
            tr5[i].style.display = "";
        }
    }
}

function getDate() {
    var d = new Date();
    var date = d.getDate();
    var month = d.getMonth();
    var year = d.getFullYear();
    document.getElementById("date").value = date + "/" + (month + 1) + "/" + year;
}

function printSection() {
    var divsToPrint = document.getElementsByClassName('printArea');
    var printContents = "";
    for (n = 0; n < divsToPrint.length; n++) {
        printContents += divsToPrint[n].innerHTML + "<br>";
    }
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}


function showHide() {
    var div = document.getElementById('filter');
    if (div.style.display === "block") {
        div.style.display = "none";
    } else {
        div.style.display = "block";
    }
}

function validateCompletionTime() {

    var isValid = true;


    var date = document.getElementById('complaint_date').value;
    var completionDate = document.getElementById('date').value;

    var err = document.getElementById('dateErr');

    if (completionDate < date) {
        isValid = false;
        err.style.display = "block";
    }
    return isValid;



}

function toggleView() {
    var x = document.getElementById("complaintFilter");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}



function toggleView2(x) {
    x = document.getElementById(x);
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}


function validateDates() {

    var date1 = document.getElementById('start_date');
    var date2 = document.getElementById('end_date');
    if (date1.value > date2.value) {
        console.log(date1.value);
        console.log(date2.value);
        var err = document.getElementById('msg');
        err.classList.remove("text-muted");
        return false;
    }
    return true;
}
function validateDates2() {

    var date1 = document.getElementById('from_date');
    var date2 = document.getElementById('to_date');
    if (date1.value > date2.value) {
        console.log(date1.value);
        console.log(date2.value);
        var err = document.getElementById('reportmsg');
        err.classList.remove("text-muted");
        return false;
    }
    return true;
}
function toggleManual()
{
    var radioManual = document.getElementById("flexRadioDefault3").checked;
    
    if(radioManual)
    {
        alert("ManualChecked");
    }
    
}
function toggleManual1()
{
    var radioWeek = document.getElementById("flexRadioDefault1").checked;

    if(radioWeek)
    {
        alert("WeekChecked");
    }
    
}
function toggleManual2()
{
    var radioMonth = document.getElementById("flexRadioDefault2").checked;
    if(radioMonth)
    {
        alert("MonthChecked");
    }
    
}

function editRemarks() {

    var rem = document.getElementById('rem');
    rem.style.display = "none";
    var updateRem = document.getElementById('update_rem');
    updateRem.style.display = "block";
    var btn = document.getElementById('edit_remarks');
    btn.style.display = "none";

}

function startEventConfirmation() {
    var btnId = this.document.activeElement.id;
    var send = false;
    if (confirm('Are you sure you want to start this event? ' + btnId)) {
        send = true;
    }
    return send;
}