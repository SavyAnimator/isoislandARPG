<?php namespace App\Services;

use App\Models\Currency\Currency;
use App\Services\CurrencyManager;
use App\Services\Service;
use Config;
use DB;

class HolService extends Service
{
    /**********************************************************************************************

    PLAY HIGHER OR LOWER (Sink or Soar)

     **********************************************************************************************/

    /**
     * make guess
     *
     * @return bool
     */
    public function makeGuess($data, $user)
    {
        DB::beginTransaction();

        try {
            if(!isset($data['guess'])) throw new \Exception('Hey, kid you need to make a guess.');

            $number = $data['number'];

            //roll second number
            //hopefully this prevents a tie occuring between the 2 numbers
            $secondnumber = mt_rand(1, 15);
            while ($secondnumber == $number) {
                $secondnumber = mt_rand(1, 15);
            }

            $guess = $data['guess'];
            if ($guess == 'soar') {
                //if $number is bigger than $secondnumber & user selected higher (soar)
                if ($number > $secondnumber) {
                    flash('Nice try, but my number was ' . $secondnumber . '...')->error();
                } elseif ($number < $secondnumber) {
                    //if $number is smaller than $secondnumber & user selected higher (soar)
                    flash('Good guess! ' . $secondnumber . ' is larger than ' . $number . '.')->success();
                    $this->creditReward($user);

                }
            } else {
                //if $number is smaller than $secondnumber & user selected smaller
                if ($number > $secondnumber) {
                    flash('Good guess! ' . $secondnumber . ' is smaller than ' . $number . '.')->success();
                    $this->creditReward($user);

                } elseif ($number < $secondnumber) {
                    flash('Nice try, but my number was ' . $secondnumber . '...')->error();
                }
            }

            return $this->commitReturn(true);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }
        return $this->rollbackReturn(false);
    }

    /**
     * make guess
     *
     * @return bool
     */
    public function creditReward($user)
    {
        DB::beginTransaction();

        try {
            $currency = Currency::find(Config::get('lorekeeper.hol.currency_id'));
            $grant = Config::get('lorekeeper.hol.currency_grant');
            if (!(new CurrencyManager())->creditCurrency(null, $user, 'SoS Grant', 'Won at Sink or Soar!', $currency, $grant)) {
                flash('Could not grant currency.')->error();
                return redirect()->back();
            }
            flash('You earned ' . $currency->display($grant). '!')->success();

            return $this->commitReturn(true);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }
        return $this->rollbackReturn(false);
    }
}
