const endpoint = 'https://040.herp.se?page=data'
let coursesData = {}

  // get courses JSON data from API endpoint
  ; (async () => {

    const response = await fetch(endpoint)
    coursesData = await response.json()
  })()
