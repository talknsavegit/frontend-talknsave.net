<?php

        class FTGLicense
        {
            public function is__premium_only()
            {
                return true;
            }

            public function is_trial()
            {
                return false;
            }

            public function is_plan_or_trial__premium_only($plan)
            {
                return "ultimate" == $plan;
            }

            public function is_plan_or_trial($plan)
            {
                return "ultimate" == $plan;
            }

            public function is_plan($plan)
            {
                return "ultimate" == $plan;
            }
            
            public function can_use_premium_code__premium_only()
            {
                return true;
            }

            public function can_use_premium_code()
            {
                return true;
            }

            public function is_free_plan()
            {
                return false;
            }

            public function get_trial_url()
            {
                return "";
            }

            public function is_plan__premium_only()
            {
                return true;
            }

            public function is_not_paying()
            {
                return false;
            }

            public function get_upgrade_url()
            {
                return "";
            }
        }
    