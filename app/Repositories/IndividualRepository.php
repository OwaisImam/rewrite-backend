<?php
namespace App\Repositories;

use App\Models\Categories;
use App\Models\Individual;
use App\Models\User;
use App\Repositories\BaseRepository;
use Carbon\Carbon;

class IndividualRepository extends BaseRepository
{

    public function model()
    {
        return Individual::class;
    }

    public function getTodaysRecords($day = null, $category_id = null)
    {
        $stmt = $this->model
        ->with(['image', 'category'])
        ->where('status', 1);

        $validDays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

        $stmt = $this->model
            ->with(['image', 'category'])
            ->where('status', 1);

        if ($day && in_array($day, $validDays)) {
            // Find the date of the most recent specified day (e.g., last Sunday)
            $currentDate = date('Y-m-d');
            $currentDayOfWeek = date('l', strtotime($currentDate));

            if ($currentDayOfWeek == $day) {
                // If today is the specified day, use today's date
                $targetDate = $currentDate;
            } else {
                // Calculate the most recent specified day
                $targetDate = date('Y-m-d', strtotime("last $day"));
            }

            $stmt = $stmt->whereDate('created_at', $targetDate);
        } else {
            // Default to today's records if no valid day is specified
            $stmt = $stmt->whereDate('created_at', date('Y-m-d'));
        }

        if($category_id) {
            $stmt = $stmt->where('category_id', $category_id);
        }

        return $stmt->get();
    }

    public function getSingleRecord($id)
    {
        return $this->model
        ->with(['image', 'category'])
        ->where('status', 1)
        ->where('id', $id)->first();
    }
}