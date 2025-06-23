<?php

include '../lifeinorganicsystem/database/queries/dbconnection.php';


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/registrationstyle.css">
</head>
<body class="landing">
    

<div class="formbold-main-wrapper">
  <div class="formbold-form-wrapper">
    <form action="../lifeinorganicsystem/database/display/lifein_addingmembers.php" method="POST">
        <div class="formbold-steps">
            <ul>
                <li class="formbold-step-menu1 active">
                    <span>1</span>
                    General Info
                </li>
                <li class="formbold-step-menu2">
                    <span>2</span>
                    Team Info
                </li>
                <li class="formbold-step-menu3">
                    <span>3</span>
                    Confirmation
                </li>
            </ul>
        </div>

        <div class="formbold-form-step-1 active">
          <div class="formbold-input-flex">
            <div>
                <label for="firstname" class="formbold-form-label"> First name </label>
                <input
                type="text"
                name="firstname"
                placeholder="Your First Name"
                id="firstname"
                class="formbold-form-input"
                />
            </div>
            <div>
                <label for="middlename" class="formbold-form-label"> Middle name </label>
                <input
                type="text"
                name="middlename"
                placeholder="Your Middle Name"
                id="middlename"
                class="formbold-form-input"
                />
            </div>
            <div>
                <label for="lastname" class="formbold-form-label"> Last name </label>
                <input
                type="text"
                name="lastname"
                placeholder="Your Last Name"
                id="lastname"
                class="formbold-form-input"
                />
            </div>
          </div>
  
          <div class="formbold-input-flex">
              <div>
                  <label for="number" class="formbold-form-label"> Contact No. </label>
                  <input 
                  type="text" 
                  name="contact" 
                  placeholder="Your Contact No."
                  id="dob" 
                  class="formbold-form-input"
                  />
              </div>
              <div>
                  <label for="email" class="formbold-form-label"> Email Address </label>
                  <input
                  type="email"
                  name="email"
                  placeholder="example@mail.com"
                  id="email"
                  class="formbold-form-input"
                  />
              </div>
          </div>

          <div class="formbold-input-flex">
              <div>
                  <label for="dob" class="formbold-form-label"> Date of Birth </label>
                  <input 
                  type="date" 
                  name="dob" 
                  id="dob" 
                  class="formbold-form-input"
                  />
              </div>
              <div>
                  <label for="email" class="formbold-form-label"> Gender </label>
                  <select name  = "gender" class = "formbold-form-input" >
                        <option value = "Male">Male</option>
                        <option value = "Female">Female</option>
                  </select>
                  <!-- <input
                  type="email"
                  name="email"
                  placeholder="example@mail.com"
                  id="email"
                  class=""
                  /> -->
              </div>
          </div>
  
          
          <div>
              <label for="address" class="formbold-form-label"> House/Street/Bldng No. </label>
              <input
              type="text"
              name="house"
              id="address"
              placeholder="Your House No., your Street and/Or Building Number"
              class="formbold-form-input"
              />
          </div>
          <br>
          <div>
              <label for="address" class="formbold-form-label"> Municipal / City </label>
              <input
              type="text"
              name="city"
              id="address"
              placeholder="Your Municipal or City"
              class="formbold-form-input"
              />
          </div>
          <br>
          <div>
              <label for="address" class="formbold-form-label"> Province </label>
              <input
              type="text"
              name="province"
              id="address"
              placeholder="Metro Manila / Cavite / Davao ...."
              class="formbold-form-input"
              />
          </div>
        </div>

        <div class="formbold-form-step-2">
            <h3>Up-Line Information</h3>
            <br>
        <div class="formbold-input-flex">
            <div>
                <label for="firstname" class="formbold-form-label"> First name </label>
                <input
                type="text"
                name="uplinefn"
                placeholder="Up-Line's First Name"
                id="firstname"
                class="formbold-form-input"
                />
            </div>
            
            <div>
                <label for="lastname" class="formbold-form-label"> Last name </label>
                <input
                type="text"
                name="uplineln"
                placeholder="Up-Line's Last Name"
                id="lastname"
                class="formbold-form-input"
                />
            </div>
          </div>
  
          <div class="formbold-input-flex">
              <div>
                  <label for="number" class="formbold-form-label"> Membership ID No. </label>
                  <input 
                  type="text" 
                  name="membershipid" 
                  placeholder="You Up-Line's ID Number."
                  id="dob" 
                  class="formbold-form-input"
                  />
              </div>
              <div>
                  <label for="dob" class="formbold-form-label"> Date of Membership </label>
                  <input 
                  type="date" 
                  name="dom" 
                  id="dob" 
                  class="formbold-form-input"
                  />
              </div>
          </div>

          
          
          <div>
              <label for="address" class="formbold-form-label"> Proof of Payment (Attachement) </label>
              <input
              type="file"
              name="payment"
              id="address"
              placeholder="Your House No., your Street and/Or Building Number"
              class="formbold-form-input"
              />
          </div>
          <br>

        </div>

        <div class="formbold-form-step-3">
          <div class="formbold-form-confirm">
            <p><b>
              WELCOME TO LIFEIN FULLNESS AND WE ARE HAPPY FOR YOU TO ON-BOARD!
            </b></p>

            <!-- <div>
              <button class="formbold-confirm-btn active">
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="11" cy="11" r="10.5" fill="white" stroke="#DDE3EC"/>
                <g clip-path="url(#clip0_1667_1314)">
                <path d="M9.83343 12.8509L15.1954 7.48828L16.0208 8.31311L9.83343 14.5005L6.12109 10.7882L6.94593 9.96336L9.83343 12.8509Z" fill="#536387"/>
                </g>
                <defs>
                <clipPath id="clip0_1667_1314">
                <rect width="14" height="14" fill="white" transform="translate(4 4)"/>
                </clipPath>
                </defs>
                </svg>
                Yes! I want it.
              </button>

              <button class="formbold-confirm-btn">
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="11" cy="11" r="10.5" fill="white" stroke="#DDE3EC"/>
                <g clip-path="url(#clip0_1667_1314)">
                <path d="M9.83343 12.8509L15.1954 7.48828L16.0208 8.31311L9.83343 14.5005L6.12109 10.7882L6.94593 9.96336L9.83343 12.8509Z" fill="#536387"/>
                </g>
                <defs>
                <clipPath id="clip0_1667_1314">
                <rect width="14" height="14" fill="white" transform="translate(4 4)"/>
                </clipPath>
                </defs>
                </svg>
                No! I don’t want it.
              </button>
            </div> -->
          </div>
        </div>

        <div class="formbold-form-btn-wrapper">
          <button class="formbold-back-btn">
            Back
            
          </button>

          <button class="formbold-btn" >
              Next Step
              <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
              <g clip-path="url(#clip0_1675_1807)">
              <path d="M10.7814 7.33312L7.20541 3.75712L8.14808 2.81445L13.3334 7.99979L8.14808 13.1851L7.20541 12.2425L10.7814 8.66645H2.66675V7.33312H10.7814Z" fill="white"/>
              </g>
              <defs>
              <clipPath id="clip0_1675_1807">
              <rect width="16" height="16" fill="white"/>
              </clipPath>
              </defs>
              </svg>
          </button>
        </div>
    </form>
  </div>
</div>

<script>
  const stepMenuOne = document.querySelector('.formbold-step-menu1')
  const stepMenuTwo = document.querySelector('.formbold-step-menu2')
  const stepMenuThree = document.querySelector('.formbold-step-menu3')

  const stepOne = document.querySelector('.formbold-form-step-1')
  const stepTwo = document.querySelector('.formbold-form-step-2')
  const stepThree = document.querySelector('.formbold-form-step-3')

  const formSubmitBtn = document.querySelector('.formbold-btn')
  const formBackBtn = document.querySelector('.formbold-back-btn')

  formSubmitBtn.addEventListener("click", function(event){
    event.preventDefault()
    if(stepMenuOne.className == 'formbold-step-menu1 active') {
        event.preventDefault()

        stepMenuOne.classList.remove('active')
        stepMenuTwo.classList.add('active')

        stepOne.classList.remove('active')
        stepTwo.classList.add('active')

        formBackBtn.classList.add('active')
        formBackBtn.addEventListener("click", function (event) {
          event.preventDefault()

          stepMenuOne.classList.add('active')
          stepMenuTwo.classList.remove('active')

          stepOne.classList.add('active')
          stepTwo.classList.remove('active')

          formBackBtn.classList.remove('active')

        })

      } else if(stepMenuTwo.className == 'formbold-step-menu2 active') {
        event.preventDefault()

        stepMenuTwo.classList.remove('active')
        stepMenuThree.classList.add('active')

        stepTwo.classList.remove('active')
        stepThree.classList.add('active')

        formBackBtn.classList.remove('active')
        formSubmitBtn.textContent = 'Submit'
        
      } else if(stepMenuThree.className == 'formbold-step-menu3 active') {
        document.querySelector('form').submit()
      }
  })
    

  
</script>

</body>
</html>