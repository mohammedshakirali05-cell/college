<?php
class ChallanHelper
{
    /**
     * Convert number to Indian words (Rupees)
     */
    public static function numberToWords($num)
    {
        $ones = ['', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];
        $teens = ['ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'];
        $tens = ['', '', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];
        $scales = ['', 'thousand', 'lakh', 'crore'];

        $num = round($num, 2);
        $parts = explode('.', $num);
        $whole = (int)$parts[0];
        $decimal = isset($parts[1]) ? (int)str_pad($parts[1], 2, '0') : 0;

        $words = '';

        if ($whole == 0) {
            $words = 'zero';
        } else {
            $groups = [];
            $group_index = 0;

            while ($whole > 0) {
                if ($group_index == 0) {
                    $group = $whole % 1000;
                } else if ($group_index == 1) {
                    $group = $whole % 100;
                } else {
                    $group = $whole % 100;
                }
                $whole = intdiv($whole, $group_index == 0 ? 1000 : 100);
                $groups[] = $group;
                $group_index++;
            }

            $group_index = count($groups) - 1;
            for ($i = count($groups) - 1; $i >= 0; $i--) {
                if ($groups[$i] != 0) {
                    $words .= self::convertGroupToWords($groups[$i], $ones, $teens, $tens) . ' ' . $scales[$i] . ' ';
                }
            }
        }

        $words = ucwords(trim($words));
        if ($decimal > 0) {
            $words .= ' and ' . $decimal . ' paise';
        }

        return trim($words) . ' rupees only';
    }

    private static function convertGroupToWords($group, $ones, $teens, $tens)
    {
        $words = '';

        $hundreds = intdiv($group, 100);
        if ($hundreds > 0) {
            $words .= $ones[$hundreds] . ' hundred ';
        }

        $remainder = $group % 100;
        if ($remainder >= 20) {
            $word = $tens[intdiv($remainder, 10)];
            $one = $remainder % 10;
            if ($one > 0) {
                $word .= ' ' . $ones[$one];
            }
            $words .= $word;
        } elseif ($remainder >= 10) {
            $words .= $teens[$remainder - 10];
        } elseif ($remainder > 0) {
            $words .= $ones[$remainder];
        }

        return trim($words);
    }

    /**
     * Generate unique challan number
     */
    public static function generateChallanNumber($db)
    {
        $date = date('Ymd');
        $query = "SELECT COUNT(*) as count FROM fees_master WHERE challan_no LIKE :date_prefix";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':date_prefix', $date . '%');
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $count = $result['count'] + 1;

        return $date . str_pad($count, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Format amount to Indian currency
     */
    public static function formatCurrency($amount)
    {
        return number_format($amount, 2, '.', ',');
    }

    /**
     * Get fees breakdown for challan
     */
    public static function getFeesBreakdown()
    {
        return [
            ['sl' => 1, 'particular' => 'Tuition Fees'],
            ['sl' => 2, 'particular' => 'Admission Fees'],
            ['sl' => 3, 'particular' => 'Association Fees'],
            ['sl' => 4, 'particular' => 'Students Aid Fund'],
            ['sl' => 5, 'particular' => 'Students Hand Book'],
            ['sl' => 6, 'particular' => 'Library Fees'],
            ['sl' => 7, 'particular' => 'College Exam Fees'],
            ['sl' => 8, 'particular' => 'Identity Card & Chest Card Fees'],
            ['sl' => 9, 'particular' => 'Poor Student Fund'],
            ['sl' => 10, 'particular' => 'Karnataka University Registration Fee'],
            ['sl' => 11, 'particular' => 'Kar. Uni. Sports Fee'],
            ['sl' => 12, 'particular' => 'Kar. Uni. Career Guidance Fund'],
            ['sl' => 13, 'particular' => 'Kar. Uni. Development Fees'],
            ['sl' => 14, 'particular' => 'Kar. Uni. Student Welfare Fund'],
            ['sl' => 15, 'particular' => 'Kar. Uni. Student Safety Fund'],
            ['sl' => 16, 'particular' => 'Kar. Uni. C.D.C. Fees'],
            ['sl' => 17, 'particular' => 'Kar. Uni. Students Aid Fund'],
            ['sl' => 18, 'particular' => 'Kar. Uni. Youth Festival Fund'],
            ['sl' => 19, 'particular' => 'Enhance Fees'],
            ['sl' => 20, 'particular' => 'Penalty'],
            ['sl' => 21, 'particular' => 'KUD Special Penalty'],
        ];
    }
}
