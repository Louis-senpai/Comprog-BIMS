<style>
   @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
*{
  margin: 0;
  padding: 0;
  outline: none;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}
body{
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
  padding: 10px;
  font-family: 'Poppins', sans-serif;
  background: linear-gradient(115deg, #56d8e4 10%, #9f01ea 90%);
}
.container{
  max-width: 800px;
  background: #fff;
  width: 800px;
  padding: 25px 40px 10px 40px;
  box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
}
.container .text{
  text-align: center;
  font-size: 41px;
  font-weight: 600;
  font-family: 'Poppins', sans-serif;
  background:blue;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}
.container form{
  padding: 30px 0 0 0;
}
.container form .form-row{
  display: flex;
  margin: 32px 0;
}
form .form-row .input-data{
  width: 100%;
  height: 40px;
  margin: 0 20px;
  position: relative;
}
form .form-row .textarea{
  height: 70px;
}
.input-data input,
.textarea textarea{
  display: block;
  width: 100%;
  height: 100%;
  border: none;
  font-size: 17px;
  border-bottom: 2px solid rgba(0,0,0, 0.12);
  color: gray;
}
.input-data input:focus ~ label, .textarea textarea:focus ~ label,
.input-data input:valid ~ label, .textarea textarea:valid ~ label{
  transform: translateY(-20px);
  font-size: 14px;
  color: #3498db;
}
.textarea textarea{
  resize: none;
  padding-top: 10px;
}
.input-data label{
  position: absolute;
  pointer-events: none;
  bottom: 10px;
  font-size: 16px;
  transition: all 0.3s ease;
  color: gray;
}
.textarea label{
  width: 100%;
  bottom: 40px;
  background: #fff;
}
.input-data .underline{
  position: absolute;
  bottom: 0;
  height: 2px;
  width: 100%;
}
.input-data .underline:before{
  position: absolute;
  content: "";
  height: 2px;
  width: 100%;
  background: #3498db;
  transform: scaleX(0);
  transform-origin: center;
  transition: transform 0.3s ease;
}
.input-data input:focus ~ .underline:before,
.input-data input:valid ~ .underline:before,
.textarea textarea:focus ~ .underline:before,
.textarea textarea:valid ~ .underline:before{
  transform: scale(1);
}

select{
   width: 320px;
   text-align: center;
   border-top: none;
   border-left: none;
   border-right: none;
   font-size: 17px;
   color: gray;
}




.submit-btn .input-data{
  overflow: hidden;
  height: 45px!important;
  width: 25%!important;
}
.submit-btn .input-data .inner{
  height: 100%;
  width: 300%;
  position: absolute;
  left: -100%;
  background: black;
  transition: all 0.4s;
}
.submit-btn .input-data:hover .inner{
  left: 0;
}
.submit-btn .input-data input{
  background: none;
  border: none;
  color: #fff;
  font-size: 17px;
  font-weight: 500;
  text-transform: uppercase;
  letter-spacing: 1px;
  cursor: pointer;
  position: relative;
  z-index: 2;
}
@media (max-width: 700px) {
  .container .text{
    font-size: 30px;
  }
  .container form{
    padding: 10px 0 0 0;
  }
  .container form .form-row{
    display: block;
  }
  form .form-row .input-data{
    margin: 35px 0!important;
  }
  .submit-btn .input-data{
    width: 40%!important;
  }
}
</style>

<div class="container">
      <div class="text">
         Personal Information
      </div>
      <form action="#">
         <div class="form-row">
            <div class="input-data">
               <input type="text" name="LastName" value="" required>
               <div class="underline"></div>
               <label for="">Last Name</label>
            </div>
            <div class="input-data">
               <input type="text" name="FirtName" value="" required>
               <div class="underline"></div>
               <label for="">First Name</label>
            </div>

            <div class="input-data">
               <input type="text" name="MiddleInitial" value="" required>
               <div class="underline"></div>
               <label for="">Middle Initial</label>
            </div>

         </div>

         <div class="form-row">
            <div class="input-data">
               <input type="text" name="Email" value="" required>
               <div class="underline"></div>
               <label for="">Email Address</label>
            </div>
            <div class="input-data">
               <input type="text" name="PhoneNumber" value="" required>
               <div class="underline"></div>
               <label for="">Phone Number</label>
            </div>
         </div>

         <div class="form-row">
            <div class="input-data">
               <input type="date" name="BirthDate" value="" required>
               <div class="underline"></div>
              
            </div>
            <div class="input-data">
               <input type="text" name="BirthPlace" value="" required>
               <div class="underline"></div>
               <label for="">BirthPlace</label>
            </div>
         </div>
         <div class="form-row">
           <div class="input-data">
               <input type="text" name="Age" value="" required>
               <div class="underline"></div>
               <label for="">Age</label>
            </div>
         </div>

         <div class="form-row">
            <div class="input-data">
            <select>
               <option value="">Sex</option>
               <option value="Male" name="Gender">Male</option>
               <option value="Female" name="Gender">Female</option>
            </select>
            </div>
            
         
         <div class="input-data">     
            <select>
               <option value="">Civil Status</option>
               <option value="Single" name="CivilStatus">Single</option>
               <option value="Married" name="CivilStatus">Married</option>
               <option value="Widowed" name="CivilStatus">Widowed</option>
               <option value="Divorced" name="CivilStatus">Divorced</option>
            </select>
            </div>   
         </div>

         <div class="form-row">
            <div class="input-data">
               <input type="text" name="Religion" value="" required>
               <div class="underline"></div>
               <label for="">Religion</label>
            </div>
            <div class="input-data">
               <input type="text" name="Dialect" value="" required>
               <div class="underline"></div>
               <label for="">Dialect</label>
            </div>
         </div>


         <div class="form-row">
            <div class="input-data">
               <select>
               <option value="">Education</option>
               <option value="Elementary" name="Education">Elementary</option>
               <option value="JHSchool" name="Education">Junior High School</option>
               <option value="SHSchool" name="Education">Senior High School</option>
               <option value="UGrad" name="Education">Under Graduate</option>
               <option value="College" name="Education">College</option>
               </select>
            </div>
         </div>

         <div class="form-row">
            <div class="input-data">
               <input type="text" name="MonthlyIncome" value="" required>
               <div class="underline"></div>
               <label for="">Monthly Income</label>
            </div>
            <div class="input-data">
               <input type="text" name="year_added" value="" required>
               <div class="underline"></div>
               <label for="">Year Added</label>
            </div>
         </div>

         <div class="form-row">
         <div class="input-data textarea">
            <textarea rows="8" cols="80" name="Remarks" value="" required></textarea>
            <br />
            <div class="underline"></div>
            <label for="">Remarks</label>
            </div>
         </div>

         
         <div class="form-row submit-btn">
               <div class="input-data">
                  <div class="inner"></div>
                  <input type="submit" value="submit">
               </div>
         </div>
            
      </form>
      </div>