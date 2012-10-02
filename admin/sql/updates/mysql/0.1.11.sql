ALTER TABLE `#__cimpay_transactions` ADD `recurring_service_id` int(11);
ALTER TABLE `#__cimpay_transactions` ADD `recurring_service_months_paid` int(11) NOT NULL DEFAULT 0;
