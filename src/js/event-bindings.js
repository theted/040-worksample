const selectElement = document.querySelector('select[name="course"]')
const dateElement = document.querySelector('select[name="date"]')
const addParticipantButton = document.querySelector('#add-participant')
const participantsElem = document.querySelector('#participants')
let numParticipants = 1

// change course event binding
selectElement.addEventListener('change', (event) => {
  let val = event.target.value
  let dates = coursesData[val].dates

  // remove current date options
  while (dateElement.options.length > 0) {
    dateElement.remove(dateElement.options.length - 1);
  }

  // add new data options
  for (i = 0; i < dates.length; i++) {
    var opt = document.createElement('option')
    opt.appendChild(document.createTextNode(dates[i]));
    opt.value = dates[i];
    dateElement.appendChild(opt)
  }

})

// create new participant
addParticipantButton.addEventListener('click', event => {
  event.preventDefault()
  console.log('Creating new participant...')
  let newParticipant = document.createElement('course-participant')
  newParticipant.setAttribute('id', ++numParticipants)
  participantsElem.appendChild(newParticipant)
})
