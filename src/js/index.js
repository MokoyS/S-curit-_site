const storedPilots = JSON.parse(localStorage.getItem('pilots')) || [];

storedPilots.forEach(pilot => {
    addPilotToList(pilot.firstName, pilot.lastName, pilot.team, pilot.points);
});

document.getElementById('pilotForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const firstName = document.getElementById('firstName').value;
    const lastName = document.getElementById('lastName').value;
    const team = document.getElementById('team').value;
    const points = document.getElementById('points').value;

    addPilot(firstName, lastName, team, points);

    this.reset();
    closeModal();
});

function addPilot(firstName, lastName, team, points) {
    const pilot = { firstName, lastName, team, points };
    storedPilots.push(pilot); 

    localStorage.setItem('pilots', JSON.stringify(storedPilots)); 
    addPilotToList(firstName, lastName, team, points);
}

function addPilotToList(firstName, lastName, team, points) {
    const pilotList = document.getElementById('pilotList');
    const li = document.createElement('li');
    li.innerHTML = `${firstName} ${lastName} - ${team} - ${points} points <button class="f1-delete-button" onclick="removePilot(this)">Supprimer</button> <?php endif;?>` ;
    pilotList.appendChild(li);
}


function removePilot(button) {
    const li = button.parentElement;
    const pilotInfo = li.innerHTML.split(' - ');
    const pilotToRemove = {
        firstName: pilotInfo[0].split(' ')[0],
        lastName: pilotInfo[0].split(' ')[1],
        team: pilotInfo[1],
        points: pilotInfo[2].split(' ')[0]
    };

    const updatedPilots = storedPilots.filter(pilot => {
        return !(pilot.firstName === pilotToRemove.firstName && pilot.lastName === pilotToRemove.lastName);
    });

    localStorage.setItem('pilots', JSON.stringify(updatedPilots)); 
    storedPilots.length = 0; 
    storedPilots.push(...updatedPilots); 
    li.remove(); 
}

const modal = document.getElementById("pilotModal");
const openModalButton = document.getElementById("openModalButton");
const closeModalButton = document.getElementById("closeModalButton");

openModalButton.onclick = function() {
    modal.style.display = "block";
}

closeModalButton.onclick = function() {
    modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target === modal) {
        modal.style.display = "none";
    }
}
