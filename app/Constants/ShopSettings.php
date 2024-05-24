<?php

namespace App\Constants;

class ShopSettings
{
    const WEEK_FORWARD = 'shop.week_forward';
    const HOUR_OFFSET = 'shop.hour_offset';
    const ONLINE_APPOINTMENT = 'shop.online_appointment';
    const MINUTES_PER_STEP = 'shop.minutes_per_step';
    const MINIMUM_STEP = 'shop.minimum_step_size';
    const MINIMUM_EDIT_TIME = 'shop.minimum_edit_time';
    const CALENDAR_RANGE = 'shop.calendar_range';
    const EXTRA_INFO = 'shop.extra_info';
    const APPOINTMENT_INFO = 'shop.appointment_information';
    const EXTRA_TREATMENT_INFO = 'shop.extra_treatment_info';
    const ENABLE_ONLINE_APPOINTMENT = 'shop.enable_online_appointment';
    const HOMEPAGE_VISIBILITY = 'shop.homepage_visibility';
    const WEEKS_FORWARD = ''; //TODO Ask Mike
    const MIN_EDIT_TIME = ''; //TODO ask @mike
    const INTERN_INFORMATION = ''; //TODO ask @mike
    const OPENING_CLOSING_VISIBILITY = 'shop.opening_closing_visibility';
    const SUBDOMAIN = 'shop.subdomain';
    const ENABLE_INVOICE_MESSAGING = 'shop.enable_invoice_messaging';
    const IS_TUTORIAL_SETTINGS_COMPLETED = 'shop.is_tutorial_settings_completed';
    const IS_TUTORIAL_OPENING_TIMES_COMPLETED = 'shop.is_tutorial_opening_times_completed';
    const IS_TUTORIAL_WORKERS_COMPLETED = 'shop.is_tutorial_workers_completed';
    const IS_TUTORIAL_TREATMENTS_COMPLETED = 'shop.is_tutorial_treatments_completed';
    const IS_TUTORIAL_OVERVIEW_COMPLETED = 'shop.is_tutorial_overview_completed';
    const IS_TUTORIAL_STANDARD_TREATMENT_COMPLETED = 'shop.is_tutorial_standard_treatment_completed';
    const TUTORIAL_ONLINE_BOOL = 'shop.tutorial_online_bool'; //TODO ask @mike
    const BADGE_DOMAIN = 'shop.badge_domain'; //TODO ask @mike
    const LANGUAGE = 'shop.language';
    const MONEYBIRD_CONTACT_ID = 'shop.moneybird_contact_id';
    const PACKAGE_PRIVATE_DOMAIN = 'shop.package_private_domain';
    const PACKAGE_DIGIBOX = 'shop.package_digibox';
    const PACKAGE_SELF_DESK = 'shop.package_self_desk';
    const PACKAGE_BARBER_AMOUNT = 'shop.package_barber_amount';
    const PACKAGE_WELCOME = 'shop.package_welcome';
    const MINUTE_PER_STEP = 'shop.minute_per_step';
    const ONLINE_PAYMENT_PERCENTAGE = 'shop.online_payment_percentage';
    const APPOINTMENT_LIMIT_PER_DEVICE = 'shop.appointment_limit_per_device';
    const APPOINTMENT_LIMIT_PER_IP = 'shop.appointment_limit_per_ip';
    const MOLLIE_ACCESS_TOKEN = 'shop.mollie_access_token';
    const MAIL_note = 'shop.mail_note';

    const DEFAULT_WEEK_FORWARD = 8;
    const DEFAULT_HOUR_OFFSET = 0;
    const DEFAULT_MINUTES_PER_STEP = 15;
    const DEFAULT_MINIMUM_STEP = 30;
    const DEFAULT_MINIMUM_EDIT_TIME = 2 * 60;
}
