namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReceiptEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $transactionId;
    public $paymentDate;
    public $amount;
    public $ticketId;
    public $driverName;
    public $driverPhoneNumber;
    public $driverEmail;
    public $driverIdNumber;
    public $driverLicenceNumber;
    public $receiptNumber;
    public $OffenceCommited;
    public $InspectorBadgeNumber;

    /**
     * Create a new message instance.
     *
     * @param  string  $transactionId
     * @param  string  $paymentDate
     * @param  float  $amount
     * @param  string  $ticketId
     * @param  string  $driverName
     * @param  string  $driverPhoneNumber
     * @param  string  $driverEmail
     * @param  string  $driverIdNumber
     * @param  string  $driverLicenceNumber
     * @param  string  $receiptNumber
     * @param  string  $OffenceCommited
     * @param  string  $InspectorBadgeNumber
     * @return void
     */
    public function __construct(
        $transactionId,
        $paymentDate,
        $amount,
        $ticketId,
        $driverName,
        $driverPhoneNumber,
        $driverEmail,
        $driverIdNumber,
        $driverLicenceNumber,
        $receiptNumber,
        $OffenceCommited,
        $InspectorBadgeNumber
    ) {
        $this->transactionId = $transactionId;
        $this->paymentDate = $paymentDate;
        $this->amount = $amount;
        $this->ticketId = $ticketId;
        $this->driverName = $driverName;
        $this->driverPhoneNumber = $driverPhoneNumber;
        $this->driverEmail = $driverEmail;
        $this->driverIdNumber = $driverIdNumber;
        $this->driverLicenceNumber = $driverLicenceNumber;
        $this->receiptNumber = $receiptNumber;
        $this->OffenceCommited = $OffenceCommited;
        $this->InspectorBadgeNumber = $InspectorBadgeNumber;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Receipt for Payment')
            ->view('PA');
    }
}
