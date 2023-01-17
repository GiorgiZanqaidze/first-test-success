

const selectElement = document.querySelector('#productType');
const itemContainer = document.querySelector('.description')


// product types data
const productTypes = [
    {
        type: "DVD",
        description: ["size"],
        measure: "MB",
        specialAttr: "size"
    },
    {
        type: "book",
        description: ['weight'],
        measure: "KG",
        specialAttr: "weight" 
    },
    {
        type: "furniture",
        description: ["height", "length", "width"],
        measure: "CM",
        specialAttr: "dimmension"
    }
]




selectElement.addEventListener('change', (event) => {
    const type = event.target.value

    if (type !== "null") {
        const chosenType = productTypes.find(item => item.type === type)
        console.log(chosenType)
        // hidden input field
        const result = chosenType.description.map((item, index) => {
            return `<div class='item-type-container' >
                    <label htmlFor=${item}>${item} (${chosenType.measure})</label>
                    <input type='text' name=${item} id=${item} />
                </div>
                `
        })
        // alert
        const alert = `
            <div class="alert">
                    Please, provide ${chosenType.specialAttr} in ${chosenType.measure}.
            </div>
        `
        result.push(alert)
        itemContainer.innerHTML = result.join('')
    }
});





