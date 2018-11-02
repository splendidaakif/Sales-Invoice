<?php

  namespace AppBundle\Controller;

  use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
  use Symfony\Bundle\FrameworkBundle\Controller\Controller;
  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\HttpFoundation\Response;

  use Symfony\Component\Form\Extension\Core\Type\TextType;
  use Symfony\Component\Form\Extension\Core\Type\DateType;
  use Symfony\Component\Form\Extension\Core\Type\SubmitType;

  use AppBundle\Entity\invoiceDescription;
  use AppBundle\Entity\invoice_iteams;


class InvoiceController extends Controller
{

     /**
      * @Route("/")
      */
      public function indexFormAction(Request $request)
      {

        return $this->render('sales/invoice.html.twig');
      }


      /**
       * @Route("submit", name="submit")
       */
       public function indexSubmitAction()
         {
            if(isset($_POST['submit']))
                {
                    $customername = $_POST['customer_name'];
                    $phone = $_POST['pho_ne'];
                    $address = $_POST['add_ress'];
                    $year = $_POST['year'];
                    $month = $_POST['month'];
                    $day = $_POST['day'];
                    $date = $day."/".$month."/".$year;
                    $newdate = date_create_from_format('d/m/Y', $date);
                    $iteams[0] = $_POST['descri_ption'];
                    $iteams[1]  =  $_POST['quan_tity'];
                    $iteams[2]  =  $_POST['unit_price'];
                    $email = $_POST['email'];


                    $inv_Des = new invoiceDescription();
                      $inv_Des->setName($customername);
                      $inv_Des->setPhone($phone);
                      $inv_Des->setAddress($address);
                      $inv_Des->setDate($newdate);
                        $emme = $this->getDoctrine()->getManager();
                        $emme->persist($inv_Des);
                        $emme->flush();



                     $arrlength=0;
                       foreach($iteams as $ite)
                       {
                         foreach($ite as $it)
                         {
                           $arrlength++;
                         }
                       }
                     $arrlength=$arrlength/3;
                       $em = $this->getDoctrine()->getManager();
                    for($x=0;$x<$arrlength;$x++)
                      {
                        $inv_Ite = new invoice_iteams();
                        $inv_Ite->setNum(0);
                        $inv_Ite->setDescription($iteams[0][$x]);
                        $inv_Ite->setQuantity($iteams[1][$x]);
                        $inv_Ite->setUnitPrice($iteams[2][$x]);
                          $em->persist($inv_Ite);
                          $em->flush();
                      }

                    $pdf = new \FPDF('p','mm','A4');
                       $pdf->AddPage();
                       $pdf->SetFont('Arial','B',14);

                       $pdf->Cell(130 ,5,'ABC COMPANY',0,0);
                       $pdf->Cell(59 ,5,'INVOICE',0,1);//end of line

                       $pdf->SetFont('Arial','',12);

                       $pdf->Cell(130 ,5,'[Street Address]',0,0);
                       $pdf->Cell(59 ,5,'',0,1);//end of line

                       $pdf->Cell(130 ,5,'[Srinagar, India, 190001]',0,0);
                       $pdf->Cell(25 ,5,'Date',0,0);
                       $pdf->Cell(34 ,5,$date,0,1);//end of line


                       $pdf->Cell(189 ,10,'',0,1);//end of line


                       $pdf->Cell(100 ,5,'Bill to',0,1);//end of line


                       $pdf->Cell(10 ,5,'',0,0);
                       $pdf->Cell(90 ,5,$customername,0,1);

                       $pdf->Cell(10 ,5,'',0,0);
                       $pdf->Cell(90 ,5,$address,0,1);

                       $pdf->Cell(10 ,5,'',0,0);
                       $pdf->Cell(90 ,5,$phone,0,1);

                       $pdf->Cell(189 ,10,'',0,1);//end of line


                       $pdf->SetFont('Arial','B',12);

                       $pdf->Cell(110 ,5,'Description',1,0);
                       $pdf->Cell(20 ,5,'Quantity',1,0);
                       $pdf->Cell(25 ,5,'Unit Price',1,0);
                       $pdf->Cell(34 ,5,'Total',1,1);//end of line

                       $pdf->SetFont('Arial','',12);
                        $grandtotal=0;
                       for($g=0;$g<$arrlength;$g++)
                        {
                          $des=$iteams[0][$g];
                          $quan=$iteams[1][$g];
                          $unit=$iteams[2][$g];

                         $pdf->Cell(110 ,5,$des,1,0);
                         $pdf->Cell(20 ,5,$quan,1,0);
                         $pdf->Cell(25 ,5,$unit,1,0);
                         $total=$quan*$unit;
                         $pdf->Cell(34 ,5,$total,1,1,'R');//end of line
                         $grandtotal=$grandtotal+$total;
                       }
                       $pdf->Cell(130 ,5,'',0,0);
                       $pdf->Cell(25 ,5,'Grand Total',0,0);
                       $pdf->Cell(9 ,5,'Rs',1,0);
                       $pdf->Cell(25 ,5,$grandtotal,1,1,'R');//end of line
                          //Save As PDF
                          $pdf->Output('invoice.pdf','F');

                          //Email Invoice
                          $message = \Swift_Message::newInstance()
                             ->setSubject('Your Invoice')
                             ->setFrom('codingkashmir@gmail.com')
                             ->setTo($email)
                             ->setBody('Find The Attachment')
                             ->setReplyTo('codingkashmir@gmail.com')
                             ->addPart('<q>Find The Attachment</q>', 'text/html')
                             ->attach(\Swift_Attachment::fromPath('invoice.pdf'));
                               $this->get('mailer')->send($message);
                            //View
                          return new Response($pdf->Output(), 200, array(
                               'Content-Type' => 'application/pdf'));


                }
            else
                {
                  return $this->render('sales/accessdenied.html.twig');
                }

         }

















































}
