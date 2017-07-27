package challenge;

import javax.swing.*;
import java.awt.*;
 
public class DatePanel extends JPanel {
   private String memo = "";
   private JLabel eventTitle;

   public DatePanel(String number) {
       setLayout(new GridLayout(2,1));
       JLabel day = new JLabel(number, SwingConstants.CENTER);
       eventTitle = new JLabel("", SwingConstants.CENTER);
 
       add(day);
       add(eventTitle);
   }
 
   public String getMemo() {
       return memo;
   }
 
   public void setMemo(String memo) {
       this.memo = memo;
   }
 
   public String getEventTitle() {
       return eventTitle.getText();
   }
 
   public void setEventTitle(String str) {
       eventTitle.setText(str);
   }
}
 
 
 

