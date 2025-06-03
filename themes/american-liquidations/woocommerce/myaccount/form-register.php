<?php
defined( 'ABSPATH' ) || exit;
// do_action( 'woocommerce_before_customer_login_form' );
?>
<div class="page-description-header py-12">
    <div class="container">
        <h1 class="text-[36px] md:text-[48px]">Sign Up</h1>
        <div class="mt-6">
            <p>Track your orders, checkout faster, and sync your favorites. Just enter your email and we’ll send you a special link that will sign you in instantly.</p>
        </div>
    </div>
</div>
<div class="bg-gray py-14">
    <div class="container">
        <form id="registrationForm" class="space-y-6">
            <div class="max-w-[830px] mx-auto p-8 md:p-12 bg-white rounded-[15px]">
                <!-- Step 1: Personal Information -->
                <div id="step1" class="">
                    <div class="mb-12">
                        <div class="text-[18px] md:text-[24px] font-bold text-black mb-5 flex justify-between items-center font-barlow">Personal Information <span class="text-sm md:text-base font-medium text-black/40 font-inter">Step 1/2</span></div>
                        <p class="text-gray-600 text-base">Lorem ipsum dolor sit amet consectetur. Justo cursus tortor id aliquam dapibus ipsum fermentum massa sit. Faucibus venenatis etiam elit eleifend. Vitae imperdiet..</p>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label for="fullName" class="block text-sm font-semibold text-black/60 mb-1">Full Name</label>
                            <input type="text" id="fullName" name="full_name" required
                                class="w-full px-3 py-2 border border-[#080404]/5 rounded-lg shadow-sm focus:outline-none focus:ring-1 focus:ring-primary focus:border-transparent transition duration-200">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-semibold text-black/60 mb-1">Email Address</label>
                            <input type="email" id="email" name="email" required
                                class="w-full px-3 py-2 border border-[#080404]/5 rounded-lg shadow-sm focus:outline-none focus:ring-1 focus:ring-primary focus:border-transparent transition duration-200">
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-semibold text-black/60 mb-1">Phone Number</label>
                            <input type="tel" id="phone" name="phone" required
                                class="w-full px-3 py-2 border border-[#080404]/5 rounded-lg shadow-sm focus:outline-none focus:ring-1 focus:ring-primary focus:border-transparent transition duration-200">
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-semibold text-black/60 mb-1">Password</label>
                            <input type="password" id="password" name="password" required
                                class="w-full px-3 py-2 border border-[#080404]/5 rounded-lg shadow-sm focus:outline-none focus:ring-1 focus:ring-primary focus:border-transparent transition duration-200">
                        </div>

                        <div>
                            <label for="confirmPassword" class="block text-sm font-semibold text-black/60 mb-1">Confirm Password</label>
                            <input type="password" id="confirmPassword" name="confirm_password" required
                                class="w-full px-3 py-2 border border-[#080404]/5 rounded-lg shadow-sm focus:outline-none focus:ring-1 focus:ring-primary focus:border-transparent transition duration-200">
                        </div>

                        <div class="custom_radio">
                            <label class="block text-sm font-semibold text-black/60 mb-1">Are you a Business?</label>
                            <div class="flex gap-3 flex-wrap md:flex-nowrap">
                                <label class="w-full flex items-center p-3 border border-[#080404]/5 rounded-lg cursor-pointer hover:border-primary transition duration-200" id="businessYesLabel">
                                    <input type="radio" id="businessYes" name="is_business" value="yes" class="w-4 h-4 text-primary focus:ring-primary active:border-primary">
                                    <span class="text-sm text-black/60">Yes, we are a Business</span>
                                </label>
                                
                                <label class="w-full flex items-center p-3 border border-[#080404]/5 rounded-lg cursor-pointer hover:border-primary transition duration-200" id="businessNoLabel">
                                    <input type="radio" id="businessNo" name="is_business" value="no" class="w-4 h-4 text-primary focus:ring-primary border-[#080404]/5">
                                    <span class="text-sm text-black/60">No, I'm an Individual</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-14 flex-wrap md:flex-nowrap">
                        <button type="button" id="nextBtn" 
                            class="btn btn-red btn-arrow hover:bg-black w-full md:w-auto">
                            NEXT
                        </button>
                        <p class="text-sm text-black/60 mt-5 md:mt-0">
                            Already have an account? 
                            <a href="<?php echo site_url(); ?>/my-account/" class="hover:text-primary font-bold">Sign in</a>
                        </p>
                    </div>
                </div>

                <!-- Step 2: Business Information -->
                <div id="step2" class="hidden">
                    <div class="mb-12">
                        <div class="text-[18px] md:text-[24px] font-bold text-black mb-3 flex justify-between items-center font-barlow">Business Information <span class="text-sm md:text-base font-medium text-black/40 font-inter">Step 2/2</span></div>
                        <p class="text-gray-600 text-base">Lorem ipsum dolor sit amet consectetur. Justo cursus tortor id aliquam dapibus ipsum fermentum massa sit. Faucibus venenatis etiam elit eleifend. Vitae imperdiet..</p>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label for="businessName" class="block text-sm font-semibold text-black/60 mb-1">Business Name</label>
                            <input type="text" id="businessName" name="business_name" required
                                class="w-full px-3 py-2 border border-[#080404]/5 rounded-lg shadow-sm focus:outline-none focus:ring-1 focus:ring-primary focus:border-transparent transition duration-200">
                        </div>

                        <div>
                            <label for="businessEin" class="block text-sm font-semibold text-black/60 mb-1">Business Registration ID (BRID)</label>
                            <input type="text" id="businessEin" name="business_ein" required
                                class="w-full px-3 py-2 border border-[#080404]/5 rounded-lg shadow-sm focus:outline-none focus:ring-1 focus:ring-primary focus:border-transparent transition duration-200">
                        </div>

                        <div>
                            <label for="businessPhone" class="block text-sm font-semibold text-black/60 mb-1">Business Phone Number</label>
                            <input type="tel" id="businessPhone" name="business_phone" required
                                class="w-full px-3 py-2 border border-[#080404]/5 rounded-lg shadow-sm focus:outline-none focus:ring-1 focus:ring-primary focus:border-transparent transition duration-200">
                        </div>

                        <div>
                            <label for="businessAddress" class="block text-sm font-semibold text-black/60 mb-1">Business Address</label>
                            <textarea id="businessAddress" name="business_address" rows="1" required
                                class="w-full px-3 py-2 border border-[#080404]/5 rounded-lg shadow-sm focus:outline-none focus:ring-1 focus:ring-primary focus:border-transparent transition duration-200 resize-none"></textarea>
                        </div>

                        <div>
                            <label for="businessType" class="block text-sm font-semibold text-black/60 mb-1">Business Type</label>
                            <select id="businessType" name="business_type" required
                                class="w-full px-3 py-2 border border-[#080404]/5 rounded-lg shadow-sm focus:outline-none focus:ring-1 focus:ring-primary focus:border-transparent transition duration-200">
                                <option value="">Select Business Type</option>
                                <option value="sole_proprietorship">Sole Proprietorship</option>
                                <option value="partnership">Partnership</option>
                                <option value="llc">LLC</option>
                                <option value="corporation">Corporation</option>
                                <option value="s_corporation">S Corporation</option>
                                <option value="non_profit">Non Profit</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div class="bg-gray px-6 py-5 rounded-xl">
                            <label for="taxDocument" class="block text-sm font-semibold text-black/60 mb-2">Tax Exempt Form:</label>
                            <p class="text-xs text-black/60 mb-4">
                                Don’t have your tax exempt form handy? Download a template
                                <a href="<?php echo site_url(); ?>/" class="underline text-gray-800 hover:text-primary">here</a>.
                            </p>

                            <div class="relative bg-white rounded-lg border hover:border-dashed border-transparent px-5 py-2 flex items-center cursor-pointer hover:border-primary transition">
                                <svg width="12" height="11" viewBox="0 0 12 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2.13932 10.7941C1.75994 10.7941 1.43529 10.6591 1.16536 10.3892C0.895422 10.1193 0.760225 9.79437 0.759766 9.41454V8.03498C0.759766 7.83954 0.825984 7.67583 0.958422 7.54386C1.09086 7.41188 1.25457 7.34566 1.44954 7.3452C1.64452 7.34474 1.80846 7.41096 1.94136 7.54386C2.07425 7.67675 2.14024 7.84046 2.13932 8.03498V9.41454H10.4167V8.03498C10.4167 7.83954 10.4829 7.67583 10.6153 7.54386C10.7478 7.41188 10.9115 7.34566 11.1064 7.3452C11.3014 7.34474 11.4654 7.41096 11.5983 7.54386C11.7312 7.67675 11.7971 7.84046 11.7962 8.03498V9.41454C11.7962 9.79391 11.6613 10.1188 11.3913 10.3892C11.1214 10.6596 10.7965 10.7946 10.4167 10.7941H2.13932ZM5.58822 2.41328L4.29488 3.70662C4.15693 3.84457 3.99322 3.91079 3.80376 3.90527C3.6143 3.89976 3.45036 3.82779 3.31195 3.68937C3.18549 3.55142 3.11927 3.39047 3.11329 3.20653C3.10731 3.02259 3.17353 2.86164 3.31195 2.72368L5.79515 0.240481C5.86413 0.171503 5.93885 0.122759 6.01933 0.0942477C6.0998 0.0657369 6.18602 0.0512517 6.27799 0.0507919C6.36997 0.050332 6.45619 0.0648172 6.53666 0.0942477C6.61714 0.123678 6.69186 0.172423 6.76084 0.240481L9.24404 2.72368C9.382 2.86164 9.44822 3.02259 9.4427 3.20653C9.43718 3.39047 9.37096 3.55142 9.24404 3.68937C9.10609 3.82733 8.94238 3.8993 8.75292 3.90527C8.56346 3.91125 8.39952 3.84503 8.26111 3.70662L6.96777 2.41328V7.3452C6.96777 7.54064 6.90155 7.70458 6.76912 7.83701C6.63668 7.96945 6.47297 8.03544 6.27799 8.03498C6.08302 8.03452 5.91931 7.9683 5.78687 7.83632C5.65443 7.70435 5.58822 7.54064 5.58822 7.3452V2.41328Z" fill="#FB0404"/>
                                </svg>
                                <label id="fileLabel" for="taxDocument" class="text-black/60 pl-4 cursor-pointer text-base">Upload Form</label>
                                <input type="file" id="taxDocument" name="tax_document" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"
                                class="absolute inset-0 opacity-0 cursor-pointer">
                            </div>

                            <p class="text-center text-xs text-primary/60 mt-4 cursor-pointer hover:text-primary">
                                Skip this for now, I’ll upload it later.
                            </p>
                        </div>

                    </div>

                    <div class="flex items-center justify-between pt-14 relative flex-wrap md:flex-nowrap">
                        <button type="button" id="backBtn" 
                            class="absolute max-w-[120px] left-0 right-0 mx-auto bottom-[-20px] md:bottom-[-40px] text-black/60 text-xs">
                            ← BACK
                        </button>
                        <button type="submit" id="submitBtn" 
                            class="btn btn-red btn-arrow hover:bg-black w-full md:w-auto">
                            Sign up
                        </button>
                        <p class="text-sm text-black/60 mt-5 md:mt-0 !mb-5 md:mb-0">
                            Already have an account? 
                            <a href="<?php echo site_url(); ?>/my-account/" class="hover:text-primary font-bold">Sign in</a>
                        </p>
                    </div>
                </div>

                <!-- Submit button for individuals (hidden by default) -->
                <button type="submit" id="submitIndividualBtn" class="hidden w-full bg-primary hover:bg-primary-dark text-white font-medium py-3 px-6 rounded-lg transition duration-200 transform hover:scale-105 focus:outline-none focus:ring-1 focus:ring-primary focus:ring-offset-2">
                    CREATE ACCOUNT
                </button>
            </div>
        </form>
    </div>
</div>


<script>
    // upload name change to file name
    document.getElementById('taxDocument').addEventListener('change', function (e) {
        const fileName = e.target.files[0]?.name || 'Upload Form';
        document.getElementById('fileLabel').textContent = fileName;
    });


    
    
    
    
    const form = document.getElementById('registrationForm');
    const step1 = document.getElementById('step1');
    const step2 = document.getElementById('step2');
    const nextBtn = document.getElementById('nextBtn');
    const backBtn = document.getElementById('backBtn');
    const submitBtn = document.getElementById('submitBtn');
    const submitIndividualBtn = document.getElementById('submitIndividualBtn');
    const businessYes = document.getElementById('businessYes');
    const businessNo = document.getElementById('businessNo');
    const businessYesLabel = document.getElementById('businessYesLabel');
    const businessNoLabel = document.getElementById('businessNoLabel');
    const progressBar = document.getElementById('progressBar');
    const step2Circle = document.getElementById('step2Circle');
    const step2Text = document.getElementById('step2Text');
    const radios = document.querySelectorAll('input[name="is_business"]');
    
    let isBusiness = false;

        radios.forEach(function (radio) {
            radio.addEventListener("change", function () {
            if (document.querySelector('input[name="is_business"]:checked').value === "no") {
                nextBtn.textContent = "Signup";
            } else {
                nextBtn.textContent = "Next";
            }
            });
        });

        // Handle radio button selection
        function handleBusinessSelection() {
            // Remove selected styles from both
            businessYesLabel.classList.remove('!border-primary');
            businessNoLabel.classList.remove('!border-primary');
            
            // Add selected style to the chosen one
            if (businessYes.checked) {
                businessYesLabel.classList.add('!border-primary');
                isBusiness = true;
            } else if (businessNo.checked) {
                businessNoLabel.classList.add('!border-primary');
                isBusiness = false;
            }
        }

        businessYes.addEventListener('change', handleBusinessSelection);
        businessNo.addEventListener('change', handleBusinessSelection);

        // Validation functions
        function validateStep1() {
            const requiredFields = ['fullName', 'email', 'phone', 'password', 'confirmPassword'];
            let isValid = true;
            let errors = [];

            // Reset all field styles
            requiredFields.forEach(fieldId => {
                const field = document.getElementById(fieldId);
                field.classList.remove('border-primary');
                field.classList.add('border-[#080404]/5');
            });

            // Check required fields
            requiredFields.forEach(fieldId => {
                const field = document.getElementById(fieldId);
                if (!field.value.trim()) {
                    isValid = false;
                    errors.push(`${field.previousElementSibling.textContent} is required`);
                    field.classList.remove('border-[#080404]/5');
                    field.classList.add('border-primary');
                }
            });

            // Check if business option is selected
            if (!businessYes.checked && !businessNo.checked) {
                isValid = false;
                errors.push('Please select if you are a business or individual');
            }

            // Email validation
            const email = document.getElementById('email').value;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (email && !emailRegex.test(email)) {
                isValid = false;
                errors.push('Please enter a valid email address');
                document.getElementById('email').classList.remove('border-[#080404]/5');
                document.getElementById('email').classList.add('border-primary');
            }

            // Password confirmation
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            if (password && confirmPassword && password !== confirmPassword) {
                isValid = false;
                errors.push('Passwords do not match');
                document.getElementById('confirmPassword').classList.remove('border-[#080404]/5');
                document.getElementById('confirmPassword').classList.add('border-primary');
            }

            if (!isValid) {
                showErrors(errors);
            }

            return isValid;
        }

        function validateStep2() {
            const requiredFields = ['businessName', 'businessEin', 'businessPhone', 'businessAddress', 'businessType'];
            let isValid = true;
            let errors = [];

            // Reset all field styles
            requiredFields.forEach(fieldId => {
                const field = document.getElementById(fieldId);
                field.classList.remove('border-primary');
                field.classList.add('border-[#080404]/5');
            });

            requiredFields.forEach(fieldId => {
                const field = document.getElementById(fieldId);
                if (!field.value.trim()) {
                    isValid = false;
                    errors.push(`${field.previousElementSibling.textContent} is required`);
                    field.classList.remove('border-[#080404]/5');
                    field.classList.add('border-primary');
                }
            });

            if (!isValid) {
                showErrors(errors);
            }

            return isValid;
        }

        function showErrors(errors) {
            alert('Please fix the following errors:\n\n' + errors.join('\n'));
        }

        // Step navigation
        function goToStep2() {
            step1.classList.add('hidden');
            step2.classList.remove('hidden');   
            
            // Update progress bar
            progressBar.style.width = '100%';
            
            // Update step 2 indicator
            step2Circle.classList.remove('bg-gray-200', 'text-gray-500');
            step2Circle.classList.add('bg-primary', 'text-white');
            step2Text.classList.remove('text-gray-500');
            step2Text.classList.add('text-primary');
        }

        function goToStep1() {
            step1.classList.remove('hidden');
            step2.classList.add('hidden');
            
            // Reset progress bar
            progressBar.style.width = '0%';
            
            // Reset step 2 indicator
            step2Circle.classList.remove('bg-primary', 'text-white');
            step2Circle.classList.add('bg-gray-200', 'text-gray-500');
            step2Text.classList.remove('text-primary');
            step2Text.classList.add('text-gray-500');
        }

        // Event listeners
        nextBtn.addEventListener('click', function() {
            if (validateStep1()) {
                if (isBusiness) {
                    goToStep2();
                } else {
                    // Submit form directly for individuals
                    submitForm();
                }
            }
        });

        backBtn.addEventListener('click', function() {
            goToStep1();
        });

        // Form submission
        function submitForm() {
            // Show loading state
            const submitButton = isBusiness ? submitBtn : nextBtn;
            const originalText = submitButton.textContent;
            submitButton.textContent = 'Creating Account...';
            submitButton.disabled = true;
            
            const formData = new FormData(form);
            
            // Add required fields for WordPress AJAX
            formData.append('action', 'register_user');
            formData.append('is_business', isBusiness ? 'yes' : 'no');
            
            // Submit to WordPress AJAX handler
            fetch(ajax_object.ajax_url, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                if (data.success) {
                    alert('Registration successful! Welcome to our platform.');
                    // Redirect to dashboard or login page
                    if (data.data.redirect_url) {
                        window.location.href = data.data.redirect_url;
                    } else {
                        window.location.href = '/wp-admin/'; // Default redirect
                    }
                } else {
                    alert('Registration failed: ' + (data.data ? data.data.message : 'Unknown error'));
                    // Reset button
                    submitButton.textContent = originalText;
                    submitButton.disabled = false;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Registration failed: Network error. Please try again.');
                // Reset button
                submitButton.textContent = originalText;
                submitButton.disabled = false;
            });
        }

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (step2.classList.contains('hidden')) {
                // Individual submission
                if (validateStep1()) {
                    submitForm();
                }
            } else {
                // Business submission
                if (validateStep2()) {
                    submitForm();
                }
            }
        });
    </script>