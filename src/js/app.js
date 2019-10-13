const endpoint = 'https://040.herp.se?page=data'
let coursesData = {}

  // get courses JSON data from API endpoint
  ; (async () => {

    const response = await fetch(endpoint)
    coursesData = await response.json()
    let options = ['--Select course--']

    for (let key in coursesData) {
      options[coursesData[key].id] = coursesData[key].name
    }

    addSelectOption(options, selectElement)

  })()
