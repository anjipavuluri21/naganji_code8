var States = [{
  key: 1,
  name: "All Governorates",
  cities: ["All Area","Abdullah Al-Salem", "Adiliya", "Bneid Al-Qar","Al Daiya","Al Dasma","Doha","Al Faiha","Granada","Kaifan","Khaldiya","Kuwait City","Al Mansouriah","Murgab","Al-Nuzha","Al Qadisiya","Qurtoba","Rawdah","Al Shamiya","Al Shuwaikh","Sulaibikhat","Al Surra","Al Yarmouk"]
},{
  key: 2,
  name: "Aasma",
  cities: ["All Area","Abdullah Al-Salem","Adiliya","Bneid Al-Qar","Al Daiya"]
},{
  key: 3,
  name: "Jahra",
  cities: ["All Area","Al Dasma","Doha","Al Faiha","Granada"]
},{
  key: 4,
  name: "Farwaniya",
  cities: ["All Area","Kaifan","Khaldiya","Kuwait City","Al Mansouriah"]
},{
  key: 5,
  name: "Hawally",
  cities: ["All Area","Murgab","Al-Nuzha","Al Qadisiya","Qurtoba"]
},{
  key: 6,
  name: "Ahmadi",
  cities: ["All Area","Rawdah","Al Shamiya","Al Shuwaikh","Sulaibikhat"]
},{
  key: 7,
  name: "Mubarak Al-Kabir",
  cities: ["All Area","Al Surra","Al Yarmouk"]
}];
//populate states
for (var i = 0; i < States.length; i++) {
  var opt = States[i];
  var el = document.createElement("option");
  el.textContent = opt.name;
  el.value = opt.key;
  StatesList.appendChild(el);
}
//Populate initial cities
populateCities();


//populate cities
function populateCities() {
  //clear the cities list
  document.getElementById('CitiesList').options.length = 0;
  var e = document.getElementById("StatesList");
  var selectedState = e.options[e.selectedIndex].value;
  var listOfCities;
  for (var i = 0; i < States.length; i++) {
    if (States[i].key == selectedState) {
      listOfCities = States[i].cities;
      break;
    }
  }
  //populate Cities DropDown menu
  for (var i = 0; i < listOfCities.length; i++) {
    var opt = listOfCities[i];
    var el = document.createElement("option");
    el.textContent = opt;
    el.value = opt;
    CitiesList.appendChild(el);
  }
}