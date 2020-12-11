'use strict'

let classificationList = document.querySelector("#classificationList");
classificationList.addEventListener("change", function () {
  let classificationId = classificationList.value;

  console.log(`classificationId is: ${classificationId}`);

  let classIdURL = "/phpmotors/vehicles/index.php?action=getInventoryItems&classificationId=" + classificationId;

  fetch(classIdURL)
  .then(function(res)  {
    if(res.ok)  {
      return res.json();
    }
    throw Error("Network response was not OK");
  })
  .then(function(data)  {
    console.log(data);
    buildInventoryList(data);
  })
  .catch(function(e)  {
    console.log('There was a problem: ', e.message);
  });
});

function buildInventoryList(data) {
  let invDisplay = document.getElementById("inventoryDisplay");
  let dataTable = '<thead>';

  dataTable += '<tr><th>Vehicle Name</th><td>&nbsp;</td><td>&nbsp;</td></tr>';
  dataTable += '</thead>';
  dataTable += '<tbody>';

  data.forEach(function (el) {
    // console.log(el.invId + ", " + el.invModel);
    dataTable += `<tr><td>${el.invMake} ${el.invModel}</td>`;
    dataTable += `<td><a href='/phpmotors/vehicles?action=mod&id=${el.invId}' title='Click to modify'>Modify</a></td>`;
    dataTable += `<td><a href='/phpmotors/vehicles?action=del&id=${el.invId}' title='Click to delete'>Delete</a></td></tr>`;
  })

  dataTable += '</tbody>';

  invDisplay.innerHTML = dataTable;
}